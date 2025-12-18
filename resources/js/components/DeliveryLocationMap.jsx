import React, { useState, useEffect, useRef } from 'react';
import axios from 'axios';
import '../../css/DeliveryLocation.css';

const DeliveryLocationMap = ({ initialLocation = 'South Kafrul, Dhaka' }) => {
  const [location, setLocation] = useState(initialLocation);
  const [selectedCoords, setSelectedCoords] = useState({ lat: 23.8103, lng: 90.4125 });
  const mapRef = useRef(null);
  const markerRef = useRef(null);
  const mapInstanceRef = useRef(null);

  // Initialize OpenStreetMap
  useEffect(() => {
    // Load Leaflet CSS
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
    link.integrity = 'sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=';
    link.crossOrigin = '';
    document.head.appendChild(link);

    // Load Leaflet JS
    const script = document.createElement('script');
    script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
    script.integrity = 'sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=';
    script.crossOrigin = '';
    script.onload = initializeMap;
    document.body.appendChild(script);

    // Cleanup
    return () => {
      if (mapInstanceRef.current) {
        mapInstanceRef.current.remove();
        mapInstanceRef.current = null;
      }
    };
  }, []);

  const initializeMap = () => {
    if (!mapRef.current || mapInstanceRef.current) return;

    // Initialize map
    const map = L.map(mapRef.current).setView([selectedCoords.lat, selectedCoords.lng], 14);
    mapInstanceRef.current = map;
    
    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      maxZoom: 19,
    }).addTo(map);

    // Add marker
    markerRef.current = L.marker([selectedCoords.lat, selectedCoords.lng], {
      draggable: true
    }).addTo(map);

    // Add popup to marker
    markerRef.current.bindPopup(`<b>Delivery Location:</b><br>${location}`).openPopup();

    // Handle marker drag end
    markerRef.current.on('dragend', async function() {
      const markerLatLng = this.getLatLng();
      setSelectedCoords({ lat: markerLatLng.lat, lng: markerLatLng.lng });
      
      // Update location via reverse geocoding
      await updateLocationFromCoords(markerLatLng.lat, markerLatLng.lng);
    });

    // Handle map click to move marker
    map.on('click', async function(e) {
      const { lat, lng } = e.latlng;
      setSelectedCoords({ lat, lng });
      
      if (markerRef.current) {
        markerRef.current.setLatLng([lat, lng]);
        markerRef.current.getPopup().setContent(`<b>Delivery Location:</b><br>Updating...`);
        markerRef.current.openPopup();
      }

      // Update location
      await updateLocationFromCoords(lat, lng);
    });
  };

  const updateLocationFromCoords = async (lat, lng) => {
    try {
      const response = await axios.get(
        `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`,
        {
          headers: {
            'User-Agent': 'MedNetDeliveryApp/1.0'
          }
        }
      );
      
      if (response.data && response.data.display_name) {
        const newLocation = response.data.display_name.split(',').slice(0, 2).join(', ');
        setLocation(newLocation);
        
        if (markerRef.current) {
          markerRef.current.getPopup().setContent(`<b>Delivery Location:</b><br>${newLocation}`);
        }
        
        // Store location in localStorage
        localStorage.setItem('mednet_delivery_location', newLocation);
        localStorage.setItem('mednet_delivery_coords', JSON.stringify({ lat, lng }));
      }
    } catch (error) {
      console.error('Error updating location:', error);
      const fallbackLocation = `Location at ${lat.toFixed(4)}, ${lng.toFixed(4)}`;
      setLocation(fallbackLocation);
      
      if (markerRef.current) {
        markerRef.current.getPopup().setContent(`<b>Delivery Location:</b><br>${fallbackLocation}`);
      }
    }
  };

  // Load saved location from localStorage
  useEffect(() => {
    const savedLocation = localStorage.getItem('mednet_delivery_location');
    const savedCoords = localStorage.getItem('mednet_delivery_coords');
    
    if (savedLocation) {
      setLocation(savedLocation);
    }
    
    if (savedCoords) {
      try {
        const coords = JSON.parse(savedCoords);
        setSelectedCoords(coords);
      } catch (e) {
        console.error('Error parsing saved coordinates:', e);
      }
    }
  }, []);

  // Handle location search
  const handleLocationSearch = async (address) => {
    try {
      const response = await axios.get(
        `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&limit=1`,
        {
          headers: {
            'User-Agent': 'MedNetDeliveryApp/1.0'
          }
        }
      );
      
      if (response.data && response.data.length > 0) {
        const result = response.data[0];
        const newCoords = { 
          lat: parseFloat(result.lat), 
          lng: parseFloat(result.lon) 
        };
        
        setSelectedCoords(newCoords);
        setLocation(result.display_name);
        
        // Update map and marker
        if (mapInstanceRef.current && markerRef.current) {
          mapInstanceRef.current.setView([newCoords.lat, newCoords.lng], 14);
          markerRef.current.setLatLng([newCoords.lat, newCoords.lng]);
          markerRef.current.getPopup().setContent(`<b>Delivery Location:</b><br>${result.display_name}`);
          markerRef.current.openPopup();
        }
        
        // Save to localStorage
        localStorage.setItem('mednet_delivery_location', result.display_name);
        localStorage.setItem('mednet_delivery_coords', JSON.stringify(newCoords));
      }
    } catch (error) {
      console.error('Error searching location:', error);
    }
  };

  return (
    <div className="delivery-map-container">
      <div className="map-header">
        <h3 className="map-title">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" className="map-icon">
            <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z" fill="currentColor"/>
          </svg>
          Delivery Area
        </h3>
        <div className="location-display">
          <span className="current-location">{location}</span>
        </div>
      </div>
      
      <div ref={mapRef} className="openstreetmap-embed" />
      
      <div className="map-controls">
        <div className="search-container">
          <input
            type="text"
            placeholder="Search for new location..."
            className="location-search"
            onKeyPress={(e) => {
              if (e.key === 'Enter') {
                handleLocationSearch(e.target.value);
                e.target.value = '';
              }
            }}
          />
          <button 
            className="search-btn"
            onClick={() => {
              const input = document.querySelector('.location-search');
              if (input.value) {
                handleLocationSearch(input.value);
                input.value = '';
              }
            }}
          >
            Search
          </button>
        </div>
        
        <div className="quick-locations">
          <p className="quick-locations-label">Quick locations:</p>
          <div className="location-tags">
            {['Gulshan', 'Banani', 'Dhanmondi', 'Mirpur', 'Uttara'].map((area) => (
              <button
                key={area}
                className="location-tag"
                onClick={() => handleLocationSearch(`${area}, Dhaka`)}
              >
                {area}
              </button>
            ))}
          </div>
        </div>
      </div>
      
      <div className="map-instructions">
        <p>📍 Drag the marker to set exact delivery location</p>
        <p>🗺️ Click anywhere on map to move marker</p>
        <p>🔍 Search for addresses above</p>
      </div>
    </div>
  );
};

export default DeliveryLocationMap;