import React, { useState } from 'react';
import './DeliveryLocation.css';

const DeliveryLocation = () => {
  const [location, setLocation] = useState('South Kafrul, Dhaka');
  const [showMapModal, setShowMapModal] = useState(false);
  const [searchQuery, setSearchQuery] = useState('');

  const handleLocationSelect = (selectedLocation) => {
    setLocation(selectedLocation);
    setShowMapModal(false);
    setSearchQuery('');
  };

  const openGoogleMaps = () => {
    // Open Google Maps in a new tab centered on the current location
    const encodedLocation = encodeURIComponent(location);
    window.open(`https://www.google.com/maps/search/?api=1&query=${encodedLocation}`, '_blank');
  };

  const popularLocations = [
    'South Kafrul, Dhaka',
    'Gulshan 1, Dhaka',
    'Banani, Dhaka',
    'Dhanmondi, Dhaka',
    'Mirpur, Dhaka',
    'Uttara, Dhaka',
    'Motijheel, Dhaka'
  ];

  return (
    <div className="delivery-location-container">
      {/* Delivery To Text */}
      <span className="delivery-label">
        Delivering To
      </span>
      
      {/* Location Display with Map Icon */}
      <div className="location-display">
        <span className="location-text">
          <span>{location}</span>
        </span>
        
        <button 
          className="map-button"
          onClick={() => setShowMapModal(true)}
          title="Change location"
        >
          <svg 
            width="20" 
            height="20" 
            viewBox="0 0 24 24" 
            fill="none" 
            xmlns="http://www.w3.org/2000/svg"
          >
            <path 
              d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z" 
              fill="currentColor"
            />
          </svg>
        </button>
      </div>

      {/* Map Modal */}
      {showMapModal && (
        <div className="map-modal-overlay">
          <div className="map-modal">
            <div className="map-modal-header">
              <h3>Select Your Location</h3>
              <button 
                className="close-button"
                onClick={() => setShowMapModal(false)}
              >
                ×
              </button>
            </div>
            
            <div className="search-container">
              <input
                type="text"
                placeholder="Enter location or address..."
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className="location-search-input"
              />
              <button 
                className="search-button"
                onClick={() => {
                  if (searchQuery) {
                    handleLocationSelect(searchQuery);
                  }
                }}
              >
                Use This Location
              </button>
            </div>

            {/* Google Maps Embed */}
            <div className="map-container">
              <iframe
                src={`https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_MAPS_API_KEY&q=${encodeURIComponent(searchQuery || location)}`}
                className="google-map-embed"
                title="Location Selector"
                allowFullScreen
              ></iframe>
              <p className="map-instruction">
                Click "Open in Google Maps" to select a precise location
              </p>
            </div>

            {/* Open Google Maps Button */}
            <button 
              className="open-google-maps-button"
              onClick={openGoogleMaps}
            >
              Open in Google Maps
            </button>

            {/* Popular Locations */}
            <div className="popular-locations">
              <h4>Popular Locations:</h4>
              <div className="location-buttons">
                {popularLocations.map((loc, index) => (
                  <button
                    key={index}
                    className="location-option"
                    onClick={() => handleLocationSelect(loc)}
                  >
                    {loc}
                  </button>
                ))}
              </div>
            </div>

            <div className="modal-actions">
              <button 
                className="cancel-button"
                onClick={() => setShowMapModal(false)}
              >
                Cancel
              </button>
              <button 
                className="confirm-button"
                onClick={() => {
                  if (searchQuery) {
                    handleLocationSelect(searchQuery);
                  } else {
                    setShowMapModal(false);
                  }
                }}
              >
                Confirm Location
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default DeliveryLocation;
