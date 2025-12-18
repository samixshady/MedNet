import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom/client';
import DeliveryLocationMap from './components/DeliveryLocationMap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const mapElement = document.getElementById('delivery-map-root');
if (mapElement) {
    const root = ReactDOM.createRoot(mapElement);
    root.render(
        React.createElement(
            React.StrictMode,
            null,
            React.createElement(DeliveryLocationMap)
        )
    );
}