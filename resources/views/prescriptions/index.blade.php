<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <style>
            * {
                --primary-color: #3b82f6;
                --primary-dark: #1e40af;
                --success-color: #10b981;
                --warning-color: #f59e0b;
                --danger-color: #ef4444;
                --dark-bg: #0f172a;
                --dark-card: #1e293b;
                --dark-border: #334155;
            }

            html.dark * {
                --primary-color: #60a5fa;
                --primary-dark: #3b82f6;
            }

            .prescription-container {
                min-height: 100vh;
                background: #f9fafb;
            }

            html.dark .prescription-container {
                background: #0f172a;
            }

            .prescription-grid {
                display: grid;
                gap: 1.5rem;
            }

            @media (min-width: 1024px) {
                .prescription-grid {
                    grid-template-columns: 350px 1fr;
                }
            }

            .prescription-sidebar {
                background: white;
                border-radius: 12px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                padding: 1.5rem;
                height: fit-content;
            }

            html.dark .prescription-sidebar {
                background: var(--dark-card);
                border: 1px solid var(--dark-border);
            }

            .prescription-main {
                background: white;
                border-radius: 12px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                padding: 1.5rem;
            }

            html.dark .prescription-main {
                background: var(--dark-card);
                border: 1px solid var(--dark-border);
            }

            .btn-add-prescription {
                width: 100%;
                padding: 0.75rem 1rem;
                background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
                color: white;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                font-size: 0.95rem;
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            }

            .btn-add-prescription:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(59, 130, 246, 0.5);
            }

            .btn-add-prescription:active {
                transform: translateY(0);
                box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
            }

            @media (max-width: 1023px) {
                .btn-add-prescription {
                    display: none !important;
                }
            }

            /* Custom Add Prescription Button */
            .Btn-Container {
                display: flex;
                width: 190px;
                height: fit-content;
                background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
                border-radius: 40px;
                box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
                justify-content: space-between;
                align-items: center;
                border: 2px solid #3b82f6;
                cursor: pointer;
                transition: all 0.3s ease;
                padding: 0;
            }

            .Btn-Container:hover {
                box-shadow: 0 12px 24px rgba(59, 130, 246, 0.5);
                transform: translateY(-2px);
                border-color: #60a5fa;
            }

            .Btn-Container:active {
                transform: translateY(0);
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            }

            .icon-Container {
                width: 50px;
                height: 50px;
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                border: 3px solid #1e40af;
                flex-shrink: 0;
            }

            .text {
                width: calc(190px - 50px);
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1rem;
                letter-spacing: 0.5px;
                font-weight: 600;
            }

            .icon-Container svg {
                transition-duration: 1.5s;
                width: 18px;
                height: 18px;
            }

            .icon-Container svg circle {
                fill: white;
                transition: all 0.3s ease;
            }

            .Btn-Container:hover .icon-Container svg {
                animation: arrow 1s linear infinite;
            }

            @keyframes arrow {
                0% {
                    opacity: 0;
                    transform: translateX(-5px);
                }
                50% {
                    opacity: 1;
                }
                100% {
                    opacity: 1;
                    transform: translateX(8px);
                }
            }

            @media (max-width: 640px) {
                .Btn-Container {
                    width: auto;
                    padding: 0.5rem;
                }

                .icon-Container {
                    width: 40px;
                    height: 40px;
                }

                .text {
                    display: none;
                }
            }

            .filter-section {
                margin-bottom: 1.5rem;
            }

            .filter-section h3 {
                font-size: 0.875rem;
                font-weight: 700;
                color: #6b7280;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                margin-bottom: 0.75rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .filter-section h3 i {
                color: var(--primary-color);
                font-size: 1rem;
            }

            html.dark .filter-section h3 {
                color: #cbd5e1;
            }

            .search-box {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                font-size: 0.875rem;
                background: white;
                color: #111;
                transition: all 0.3s ease;
            }

            .search-box:focus {
                outline: none;
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }

            html.dark .search-box {
                background: var(--dark-bg);
                border-color: var(--dark-border);
                color: #f1f5f9;
            }

            html.dark .search-box:focus {
                border-color: #60a5fa;
                box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
            }

            .tag-filter {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .tag-chip {
                padding: 0.625rem 1rem;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                border: 2.5px solid;
                text-transform: capitalize;
            }

            .tag-chip.active {
                background-color: var(--primary-color);
                color: white;
                border-color: var(--primary-color);
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
                transform: scale(1.05);
            }

            .tag-chip:not(.active) {
                background-color: #f3f4f6;
                color: #6b7280;
                border-color: #e5e7eb;
            }

            .tag-chip:not(.active):hover {
                background-color: #e5e7eb;
                border-color: var(--primary-color);
                transform: translateY(-2px);
            }

            html.dark .tag-chip:not(.active) {
                background-color: rgba(51, 65, 85, 0.5);
                color: #cbd5e1;
                border-color: var(--dark-border);
            }

            html.dark .tag-chip:not(.active):hover {
                background-color: rgba(51, 65, 85, 0.8);
                border-color: #60a5fa;
            }

            html.dark .tag-chip.active {
                background-color: #60a5fa;
                border-color: #60a5fa;
                box-shadow: 0 4px 12px rgba(96, 165, 250, 0.4);
            }

            .sort-select {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                font-size: 0.875rem;
                background: white;
                color: #111;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .sort-select:focus {
                outline: none;
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
                background: white;
            }

            html.dark .sort-select {
                background: var(--dark-bg);
                border-color: var(--dark-border);
                color: #f1f5f9;
            }

            html.dark .sort-select:focus {
                border-color: #60a5fa;
                box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
            }

            .prescription-list {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .prescription-card {
                background: white;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                padding: 1rem;
                cursor: pointer;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .prescription-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 4px;
                height: 0%;
                background: linear-gradient(180deg, var(--primary-color), var(--primary-dark));
                transition: height 0.3s ease;
            }

            .prescription-card:hover::before {
                height: 100%;
            }

            .prescription-card:hover {
                border-color: var(--primary-color);
                box-shadow: 0 8px 24px rgba(59, 130, 246, 0.15);
                transform: translateY(-4px);
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.02), rgba(59, 130, 246, 0.01));
            }

            .prescription-card.active {
                border-color: var(--primary-color);
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(59, 130, 246, 0.04));
                box-shadow: 0 8px 24px rgba(59, 130, 246, 0.2);
            }

            html.dark .prescription-card {
                background: rgba(30, 41, 59, 0.5);
                border-color: var(--dark-border);
            }

            html.dark .prescription-card:hover {
                border-color: #60a5fa;
                box-shadow: 0 8px 24px rgba(96, 165, 250, 0.2);
                background: rgba(30, 41, 59, 0.8);
            }

            html.dark .prescription-card.active {
                border-color: #60a5fa;
                background: rgba(96, 165, 250, 0.1);
                box-shadow: 0 8px 24px rgba(96, 165, 250, 0.25);
            }

            .prescription-card-title {
                font-weight: 700;
                color: #111;
                margin-bottom: 0.5rem;
                font-size: 0.95rem;
            }

            html.dark .prescription-card-title {
                color: #f1f5f9;
            }

            .prescription-card-meta {
                font-size: 0.8rem;
                color: #6b7280;
                display: flex;
                gap: 1rem;
                margin-bottom: 0.5rem;
            }

            html.dark .prescription-card-meta {
                color: #94a3b8;
            }

            .prescription-card-tags {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .prescription-card-tag {
                display: inline-block;
                padding: 0.25rem 0.5rem;
                border-radius: 4px;
                font-size: 0.75rem;
                font-weight: 600;
                color: white;
            }

            .empty-state {
                text-align: center;
                padding: 3rem 1rem;
                color: #6b7280;
            }

            html.dark .empty-state {
                color: #94a3b8;
            }

            .empty-state-icon {
                font-size: 3rem;
                margin-bottom: 1rem;
                opacity: 0.5;
            }

            .empty-state-title {
                font-size: 1.125rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
                color: #111;
            }

            html.dark .empty-state-title {
                color: #f1f5f9;
            }

            .prescription-detail {
                display: none;
                opacity: 0;
            }

            .prescription-detail.active {
                display: block;
                animation: slideInUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            }

            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(40px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes slideOutDown {
                from {
                    opacity: 1;
                    transform: translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateY(40px);
                }
            }

            .prescription-detail.closing {
                animation: slideOutDown 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            }

            .prescription-detail-header {
                display: flex;
                justify-content: space-between;
                align-items: start;
                margin-bottom: 1.5rem;
                padding-bottom: 1.5rem;
                border-bottom: 2px solid #e5e7eb;
                gap: 1rem;
            }

            html.dark .prescription-detail-header {
                border-color: var(--dark-border);
            }

            .prescription-detail-title {
                font-size: 1.75rem;
                font-weight: 800;
                color: #111;
                letter-spacing: -0.5px;
            }

            html.dark .prescription-detail-title {
                color: #f1f5f9;
            }

            .btn-group {
                display: flex;
                gap: 0.75rem;
                flex-wrap: wrap;
            }

            .btn-small {
                padding: 0.625rem 1rem;
                border: 2px solid;
                border-radius: 8px;
                font-size: 0.85rem;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                display: flex;
                align-items: center;
                gap: 0.5rem;
                white-space: nowrap;
                position: relative;
                overflow: hidden;
            }

            .btn-small i {
                font-size: 1rem;
                transition: transform 0.3s ease;
            }

            .btn-primary-small {
                background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
                color: white;
                border-color: var(--primary-dark);
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            }

            .btn-primary-small:hover {
                background: linear-gradient(135deg, var(--primary-dark), #1e3a8a);
                border-color: #1e3a8a;
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
            }

            .btn-primary-small:active {
                transform: translateY(0);
            }

            .btn-danger-small {
                background: transparent;
                color: var(--danger-color);
                border-color: var(--danger-color);
                transition: all 0.3s ease;
            }

            .btn-danger-small:hover {
                background: var(--danger-color);
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            }

            .btn-danger-small:active {
                transform: translateY(0);
            }

            .detail-section {
                margin-bottom: 1.75rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid #f0f0f0;
            }

            .detail-section:last-child {
                border-bottom: none;
                padding-bottom: 0;
                margin-bottom: 0;
            }

            html.dark .detail-section {
                border-color: rgba(100, 116, 139, 0.3);
            }

            .detail-label {
                font-size: 0.75rem;
                font-weight: 800;
                color: #6b7280;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                margin-bottom: 0.75rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .detail-label i {
                color: var(--primary-color);
                font-size: 0.95rem;
            }

            html.dark .detail-label {
                color: #94a3b8;
            }

            .detail-value {
                font-size: 1rem;
                color: #111;
                font-weight: 500;
                line-height: 1.6;
            }

            html.dark .detail-value {
                color: #e2e8f0;
            }

            .file-preview {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
                margin-top: 0.75rem;
            }

            .file-item {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.875rem;
                background: linear-gradient(135deg, #f0f9ff, #f0fdf4);
                border-radius: 8px;
                font-size: 0.85rem;
                border: 2px solid #e0f2fe;
                transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                cursor: pointer;
                text-decoration: none;
                color: #111;
                font-weight: 600;
                user-select: none;
            }

            .file-item:hover {
                background: linear-gradient(135deg, #e0f2fe, #dcfce7);
                border-color: var(--primary-color);
                transform: translateY(-3px);
                box-shadow: 0 8px 20px rgba(59, 130, 246, 0.25);
            }

            .file-item:active {
                transform: translateY(-1px);
            }

            html.dark .file-item {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(16, 185, 129, 0.1));
                border-color: rgba(59, 130, 246, 0.3);
                color: #e2e8f0;
            }

            html.dark .file-item:hover {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(16, 185, 129, 0.2));
                border-color: #60a5fa;
                box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
            }

            /* File Preview Modal */
            .file-preview-modal {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.6);
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 9000;
                padding: 1rem;
                backdrop-filter: blur(4px);
                animation: fadeInBackdrop 0.3s ease;
            }

            @keyframes fadeInBackdrop {
                from {
                    opacity: 0;
                    backdrop-filter: blur(0px);
                }
                to {
                    opacity: 1;
                    backdrop-filter: blur(4px);
                }
            }

            .file-preview-modal.active {
                display: flex;
            }

            .file-preview-modal.closing {
                animation: fadeOutBackdrop 0.3s ease forwards;
            }

            @keyframes fadeOutBackdrop {
                from {
                    opacity: 1;
                    backdrop-filter: blur(4px);
                }
                to {
                    opacity: 0;
                    backdrop-filter: blur(0px);
                }
            }

            .file-preview-content {
                background: white;
                border-radius: 16px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                overflow: hidden;
                max-width: 90vw;
                max-height: 90vh;
                width: 100%;
                display: flex;
                flex-direction: column;
                animation: scaleIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            }

            html.dark .file-preview-content {
                background: #1f2937;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8);
            }

            .file-preview-content.closing {
                animation: scaleOut 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            }

            @keyframes scaleIn {
                from {
                    opacity: 0;
                    transform: scale(0.9) translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: scale(1) translateY(0);
                }
            }

            @keyframes scaleOut {
                from {
                    opacity: 1;
                    transform: scale(1) translateY(0);
                }
                to {
                    opacity: 0;
                    transform: scale(0.9) translateY(20px);
                }
            }

            .file-icon {
                font-size: 1.5rem;
                flex-shrink: 0;
            }

            .upcoming-reminder {
                background: linear-gradient(135deg, #fffbeb, #fef3c7);
                border-left: 5px solid var(--warning-color);
                padding: 1.25rem;
                border-radius: 8px;
                margin-bottom: 1rem;
                box-shadow: 0 4px 12px rgba(245, 158, 11, 0.15);
                transition: all 0.3s ease;
            }

            .upcoming-reminder:hover {
                box-shadow: 0 6px 16px rgba(245, 158, 11, 0.25);
                transform: translateY(-2px);
            }

            html.dark .upcoming-reminder {
                background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.1));
                border-left-color: #fbbf24;
            }

            .reminder-text {
                color: #92400e;
                font-size: 0.9rem;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .reminder-text i {
                font-size: 1.25rem;
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: 0.7;
                }
            }

            html.dark .reminder-text {
                color: #fbbf24;
            }

            .skeleton {
                background: linear-gradient(90deg, #e5e7eb 25%, #f3f4f6 50%, #e5e7eb 75%);
                background-size: 200% 100%;
                animation: loading 1.5s infinite;
                border-radius: 6px;
            }

            @keyframes loading {
                0% { background-position: 200% 0; }
                100% { background-position: -200% 0; }
            }

            .btn-back-modern {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                padding: 0.75rem 1.25rem;
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
                color: var(--primary-color);
                border: 2px solid var(--primary-color);
                border-radius: 10px;
                cursor: pointer;
                font-weight: 700;
                font-size: 0.95rem;
                transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                position: relative;
                overflow: hidden;
                margin-bottom: 1.5rem;
            }

            .btn-back-modern::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.5s ease;
            }

            .btn-back-modern:hover {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(59, 130, 246, 0.1));
                border-color: var(--primary-dark);
                transform: translateX(-4px);
                box-shadow: -4px 8px 16px rgba(59, 130, 246, 0.25);
                color: var(--primary-dark);
            }

            .btn-back-modern:hover::before {
                left: 100%;
            }

            .btn-back-modern:active {
                transform: translateX(-2px);
            }

            .btn-back-modern i {
                font-size: 1.1rem;
                transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            }

            .btn-back-modern:hover i {
                transform: translateX(-2px);
            }

            html.dark .btn-back-modern {
                background: linear-gradient(135deg, rgba(96, 165, 250, 0.15), rgba(96, 165, 250, 0.05));
                border-color: #60a5fa;
                color: #60a5fa;
            }

            html.dark .btn-back-modern:hover {
                background: linear-gradient(135deg, rgba(96, 165, 250, 0.25), rgba(96, 165, 250, 0.15));
                border-color: #93c5fd;
                color: #93c5fd;
                box-shadow: -4px 8px 16px rgba(96, 165, 250, 0.3);
            }

            @media (max-width: 767px) {
                .prescription-grid {
                    grid-template-columns: 1fr;
                }

                .prescription-sidebar {
                    position: fixed;
                    left: -350px;
                    top: 0;
                    width: 300px;
                    height: 100vh;
                    overflow-y: auto;
                    z-index: 30;
                    transition: left 0.3s ease;
                    border-radius: 0;
                }

                .prescription-sidebar.open {
                    left: 0;
                }

                .prescription-detail {
                    display: none;
                }

                .prescription-detail.active {
                    display: block;
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    z-index: 35;
                    overflow-y: auto;
                    background: white;
                    border-radius: 0;
                    padding: 1rem;
                    padding-top: max(1rem, env(safe-area-inset-top));
                    padding-bottom: max(6rem, env(safe-area-inset-bottom));
                }

                html.dark .prescription-detail.active {
                    background: var(--dark-card);
                }

                .btn-back-modern {
                    position: fixed;
                    bottom: 2rem;
                    left: 1rem;
                    right: 1rem;
                    width: calc(100% - 2rem);
                    justify-content: center;
                    display: flex;
                    padding: 0.875rem 1.25rem;
                    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
                    color: white;
                    border: none;
                    font-size: 0.95rem;
                    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
                    border-radius: 12px;
                    gap: 0.5rem;
                    font-weight: 600;
                    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
                    align-items: center;
                    flex-shrink: 0;
                    z-index: 40;
                    margin: 0;
                }

                .btn-back-modern:hover {
                    background: linear-gradient(135deg, #2563eb, #1e40af);
                    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
                    transform: translateY(-2px);
                }

                .btn-back-modern:active {
                    transform: translateY(0);
                }

                html.dark .btn-back-modern {
                    background: linear-gradient(135deg, #2563eb, #1e40af);
                    border: none;
                    color: white;
                    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
                }

                html.dark .btn-back-modern:hover {
                    background: linear-gradient(135deg, #1d4ed8, #1e3a8a);
                    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
                }

                /* Draggable Prescription Detail */
                .prescription-detail.active {
                    transform: translateY(0);
                    will-change: transform;
                }

                .prescription-detail.dragging {
                    transition: none !important;
                }
            }

            @media (max-width: 639px) {
                .prescription-container {
                    padding: 1rem;
                }

                .prescription-main {
                    padding: 1rem;
                }
            }

            /* Custom Close Button */
            .close-button {
                position: relative;
                width: 2.5rem;
                height: 2.5rem;
                border: none;
                background: rgba(180, 83, 107, 0.11);
                border-radius: 5px;
                transition: background 0.5s;
                cursor: pointer;
            }

            .close-button .X {
                content: "";
                position: absolute;
                top: 50%;
                left: 50%;
                width: 1.5em;
                height: 1.5px;
                background-color: rgb(255, 255, 255);
                transform: translateX(-50%) rotate(45deg);
            }

            .close-button .Y {
                content: "";
                position: absolute;
                top: 50%;
                left: 50%;
                width: 1.5em;
                height: 1.5px;
                background-color: #fff;
                transform: translateX(-50%) rotate(-45deg);
            }

            .close-button .close-label {
                position: absolute;
                display: flex;
                padding: 0.6rem 1rem;
                align-items: center;
                justify-content: center;
                transform: translateX(-50%);
                top: -65%;
                left: 50%;
                width: 2.5em;
                height: 1.5em;
                font-size: 11px;
                background-color: rgb(19, 22, 24);
                color: rgb(187, 229, 236);
                border: none;
                border-radius: 3px;
                pointer-events: none;
                opacity: 0;
                white-space: nowrap;
            }

            .close-button:hover {
                background-color: rgb(211, 21, 21);
            }

            .close-button:active {
                background-color: rgb(130, 0, 0);
            }

            .close-button:hover > .close-label {
                animation: closeAnim 0.2s forwards 0.25s;
            }

            @keyframes closeAnim {
                100% {
                    opacity: 1;
                }
            }

            /* Modern Header Styling */
            .prescription-header {
                background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
                padding: 2rem 0;
                border-bottom: 2px solid #e5e7eb;
                margin-bottom: 2rem;
            }

            html.dark .prescription-header {
                background: linear-gradient(135deg, var(--dark-card) 0%, rgba(30, 41, 59, 0.7) 100%);
                border-bottom-color: var(--dark-border);
            }

            .prescription-header h1 {
                background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                transition: all 0.3s ease;
            }

            .prescription-header h1 i {
                font-size: 2rem;
                color: var(--primary-color);
            }

            /* Smooth animations */
            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .prescription-card {
                animation: slideInUp 0.3s ease-out;
            }

            /* Scrollbar styling */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f5f9;
            }

            html.dark ::-webkit-scrollbar-track {
                background: var(--dark-bg);
            }

            ::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }

            html.dark ::-webkit-scrollbar-thumb {
                background: #475569;
            }

            html.dark ::-webkit-scrollbar-thumb:hover {
                background: #64748b;
            }

            /* Smooth transitions */
            * {
                --transition-speed: 0.3s;
            }

            button, select, input, textarea {
                transition: all var(--transition-speed) cubic-bezier(0.34, 1.56, 0.64, 1);
            }
        </style>
    </x-slot>

    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="pt-0 pb-2 sm:py-12">
            <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6 flex items-center justify-between gap-6">
                <div class="flex-1 text-center">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 flex items-center justify-center gap-3">
                        <i class='bx bx-file'></i> My Prescriptions
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Organize and manage your medical prescriptions</p>
                </div>
                <!-- Custom Design Button - All Devices -->
                <button class="Btn-Container" onclick="openAddModal()">
                    <span class="text">Add Prescription</span>
                    <span class="icon-Container">
                        <svg
                            width="18"
                            height="20"
                            viewBox="0 0 16 19"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <circle cx="1.61321" cy="1.61321" r="1.5" fill="white"></circle>
                            <circle cx="5.73583" cy="1.61321" r="1.5" fill="white"></circle>
                            <circle cx="5.73583" cy="5.5566" r="1.5" fill="white"></circle>
                            <circle cx="9.85851" cy="5.5566" r="1.5" fill="white"></circle>
                            <circle cx="9.85851" cy="9.5" r="1.5" fill="white"></circle>
                            <circle cx="13.9811" cy="9.5" r="1.5" fill="white"></circle>
                            <circle cx="5.73583" cy="13.4434" r="1.5" fill="white"></circle>
                            <circle cx="9.85851" cy="13.4434" r="1.5" fill="white"></circle>
                            <circle cx="1.61321" cy="17.3868" r="1.5" fill="white"></circle>
                            <circle cx="5.73583" cy="17.3868" r="1.5" fill="white"></circle>
                        </svg>
                    </span>
                </button>
            </div>

            <!-- Main Grid -->
            <div class="prescription-grid">
                <!-- Sidebar / Filters -->
                <aside class="prescription-sidebar">
                    <!-- Search -->
                    <div class="filter-section">
                        <input 
                            type="text" 
                            id="searchInput" 
                            class="search-box" 
                            placeholder="Search prescriptions..."
                            onkeyup="filterPrescriptions()"
                        >
                    </div>

                    <!-- Tags Filter -->
                    @if($tags->count() > 0)
                    <div class="filter-section">
                        <h3><i class='bx bx-tag'></i> Tags</h3>
                        <div class="tag-filter">
                            @foreach($tags as $tag)
                            <button 
                                class="tag-chip" 
                                onclick="filterByTag({{ $tag->id }}, this)"
                                style="background-color: {{ $tag->color }}20; color: {{ $tag->color }}; border-color: {{ $tag->color }}"
                                data-tag-id="{{ $tag->id }}"
                            >
                                {{ $tag->name }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Sort -->
                    <div class="filter-section">
                        <h3><i class='bx bx-sort'></i> Sort By</h3>
                        <select class="sort-select" onchange="sortPrescriptions(this.value)">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="upcoming">Upcoming Visit</option>
                        </select>
                    </div>

                    <!-- Upcoming Reminders -->
                    @if($upcomingReminders > 0)
                    <div class="filter-section">
                        <div class="upcoming-reminder">
                            <div class="reminder-text">
                                <i class='bx bx-bell'></i> {{ $upcomingReminders }} upcoming reminder(s)
                            </div>
                        </div>
                    </div>
                    @endif
                </aside>

                <!-- Main Content -->
                <main class="prescription-main">
                    <!-- Prescription List -->
                    <div class="prescription-list" id="prescriptionList">
                        @forelse($prescriptions as $prescription)
                        <div 
                            class="prescription-card" 
                            onclick="selectPrescription(this, {{ $prescription->id }})"
                            data-prescription-id="{{ $prescription->id }}"
                            data-prescription-date="{{ $prescription->prescription_date }}"
                            data-next-visit-date="{{ $prescription->next_visit_date ?? '9999-12-31' }}"
                        >
                            <div class="prescription-card-title">
                                {{ $prescription->title }}
                            </div>
                            <div class="prescription-card-meta">
                                @if($prescription->doctor_name)
                                <span><i class='bx bx-user'></i> {{ $prescription->doctor_name }}</span>
                                @endif
                                <span><i class='bx bx-calendar'></i> {{ $prescription->prescription_date->format('M d, Y') }}</span>
                            </div>
                            @if($prescription->tags->count() > 0)
                            <div class="prescription-card-tags">
                                @foreach($prescription->tags as $tag)
                                <span 
                                    class="prescription-card-tag" 
                                    style="background-color: {{ $tag->color }}"
                                >
                                    {{ $tag->name }}
                                </span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @empty
                        <div class="empty-state">
                            <div class="empty-state-icon">📋</div>
                            <div class="empty-state-title">No prescriptions yet</div>
                            <p>Start by adding your first prescription</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Prescription Detail View -->
                    <div id="prescriptionDetail" class="prescription-detail">
                        <button class="btn-back-modern" onclick="backToPrescriptionList()">
                            <i class='bx bx-chevron-left'></i> Back to List
                        </button>
                        <div id="detailContent"></div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- File Preview Modal -->
    <div id="filePreviewModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4" style="display: none;">
        <div class="bg-white dark:bg-slate-800 rounded-20 shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300" style="animation: scaleIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-slate-700 sticky top-0 bg-white dark:bg-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                        <i id="filePreviewIcon" class="bx bx-file text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 id="filePreviewName" class="font-bold text-lg text-gray-900 dark:text-white">File Name</h3>
                        <p id="filePreviewType" class="text-sm text-gray-500 dark:text-gray-400">File Type</p>
                    </div>
                </div>
                <button onclick="closeFilePreview()" class="close-preview-button">
                    <span class="X"></span>
                    <span class="Y"></span>
                    <div class="close">Close</div>
                </button>
            </div>

            <!-- Content with Zoom Controls -->
            <div class="p-6 relative">
                <!-- Zoom Controls -->
                <div class="absolute top-8 right-8 flex gap-2 bg-white dark:bg-slate-700 rounded-lg shadow-md p-2 z-10">
                    <button onclick="zoomOut()" class="w-10 h-10 rounded bg-gray-100 dark:bg-slate-600 hover:bg-blue-500 hover:text-white text-gray-700 dark:text-gray-200 transition-all flex items-center justify-center font-bold">−</button>
                    <div id="zoomLevel" class="w-12 h-10 rounded bg-gray-100 dark:bg-slate-600 text-gray-700 dark:text-gray-200 flex items-center justify-center font-bold text-sm">100%</div>
                    <button onclick="zoomIn()" class="w-10 h-10 rounded bg-gray-100 dark:bg-slate-600 hover:bg-blue-500 hover:text-white text-gray-700 dark:text-gray-200 transition-all flex items-center justify-center font-bold">+</button>
                    <button onclick="resetZoom()" class="w-10 h-10 rounded bg-gray-100 dark:bg-slate-600 hover:bg-blue-500 hover:text-white text-gray-700 dark:text-gray-200 transition-all flex items-center justify-center font-bold" title="Reset">↺</button>
                </div>

                <div id="filePreviewContent" class="rounded-lg overflow-hidden bg-gray-50 dark:bg-slate-900 flex items-center justify-center min-h-96">
                    <!-- Placeholder for image or PDF -->
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-3 p-6 border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-900">
                <button onclick="printFile()" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-lg font-semibold transition-all duration-200 hover:shadow-lg hover:scale-[1.02] active:scale-95">
                    <i class='bx bx-printer text-lg'></i>
                    <span>Print</span>
                </button>
                <button onclick="downloadFile()" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold transition-all duration-200 hover:shadow-lg hover:scale-[1.02] active:scale-95">
                    <i class='bx bx-download text-lg'></i>
                    <span>Download</span>
                </button>
                <button onclick="closeFilePreview()" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 bg-gray-200 dark:bg-slate-700 hover:bg-gray-300 dark:hover:bg-slate-600 text-gray-800 dark:text-white rounded-lg font-semibold transition-all duration-200 hover:shadow-lg hover:scale-[1.02] active:scale-95">
                    <i class='bx bx-x text-lg'></i>
                    <span>Close</span>
                </button>
            </div>
        </div>
    </div>

    <style>
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .close-preview-button {
            position: relative;
            width: 4em;
            height: 4em;
            border: none;
            background: rgba(180, 83, 107, 0.11);
            border-radius: 5px;
            transition: background 0.5s;
            cursor: pointer;
        }

        .close-preview-button .X {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 2em;
            height: 1.5px;
            background-color: rgb(255, 255, 255);
            transform: translateX(-50%) rotate(45deg);
        }

        .close-preview-button .Y {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 2em;
            height: 1.5px;
            background-color: #fff;
            transform: translateX(-50%) rotate(-45deg);
        }

        .close-preview-button .close {
            position: absolute;
            display: flex;
            padding: 0.8rem 1.5rem;
            align-items: center;
            justify-content: center;
            transform: translateX(-50%);
            top: -70%;
            left: 50%;
            width: 3em;
            height: 1.7em;
            font-size: 12px;
            background-color: rgb(19, 22, 24);
            color: rgb(187, 229, 236);
            border: none;
            border-radius: 3px;
            pointer-events: none;
            opacity: 0;
            white-space: nowrap;
        }

        .close-preview-button:hover {
            background-color: rgb(211, 21, 21);
        }

        .close-preview-button:active {
            background-color: rgb(130, 0, 0);
        }

        .close-preview-button:hover > .close {
            animation: closeLabel 0.2s forwards 0.25s;
        }

        @keyframes closeLabel {
            100% {
                opacity: 1;
            }
        }
    </style>

    <!-- Add/Edit Modal -->
    <div id="prescriptionModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 backdrop-blur-sm overflow-y-auto">
        <div class="bg-white dark:bg-gray-800 rounded-2xl w-full max-w-2xl shadow-2xl my-auto overflow-hidden flex flex-col">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-900 dark:to-blue-800 p-6 flex justify-between items-center">
                <div>
                    <h2 class="prescription-modal-title text-2xl font-bold text-white flex items-center gap-2">
                        <i class='bx bx-plus-circle'></i> Add New Prescription
                    </h2>
                    <p class="text-blue-100 text-sm mt-1">Organize your medical documents</p>
                </div>
                <button onclick="closeModal()" class="close-button">
                    <span class="X"></span>
                    <span class="Y"></span>
                    <div class="close-label">Close</div>
                </button>
            </div>

            <form id="prescriptionForm" class="p-6 space-y-3 overflow-y-auto max-h-[calc(100vh-220px)]">
                @csrf

                <!-- Title -->
                <div>
                    <label class="block text-xs font-semibold text-gray-800 dark:text-gray-200 mb-1 flex items-center gap-1">
                        <i class='bx bx-file-blank' style="color: #3b82f6;"></i>
                        Prescription Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" required class="w-full px-3 py-1.5 border-2 border-gray-200 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-200 dark:focus:ring-blue-900 outline-none transition duration-200 text-sm" placeholder="e.g., Eye Checkup Prescription">
                </div>

                <!-- Date -->
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-semibold text-gray-800 dark:text-gray-200 mb-1 flex items-center gap-1">
                            <i class='bx bx-calendar' style="color: #3b82f6;"></i>
                            Prescription Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="prescription_date" required class="w-full px-3 py-1.5 border-2 border-gray-200 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-200 dark:focus:ring-blue-900 outline-none transition duration-200 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-800 dark:text-gray-200 mb-1 flex items-center gap-1">
                            <i class='bx bx-calendar-check' style="color: #10b981;"></i>
                            Next Visit Date
                        </label>
                        <input type="date" name="next_visit_date" class="w-full px-3 py-1.5 border-2 border-gray-200 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-200 dark:focus:ring-blue-900 outline-none transition duration-200 text-sm">
                    </div>
                </div>

                <!-- Doctor -->
                <div>
                    <label class="block text-xs font-semibold text-gray-800 dark:text-gray-200 mb-1 flex items-center gap-1">
                        <i class='bx bx-user-md' style="color: #3b82f6;"></i>
                        Doctor / Hospital Name
                    </label>
                    <input type="text" name="doctor_name" class="w-full px-3 py-1.5 border-2 border-gray-200 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-200 dark:focus:ring-blue-900 outline-none transition duration-200 text-sm" placeholder="e.g., Dr. Smith / Eye Hospital">
                </div>

                <!-- Tags -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-xs font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-1">
                            <i class='bx bx-tag' style="color: #3b82f6;"></i>
                            Tags
                        </label>
                        <button type="button" onclick="toggleCreateTag()" class="text-xs font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 flex items-center gap-0.5 px-2 py-0.5 bg-blue-50 dark:bg-blue-900 dark:bg-opacity-30 rounded transition">
                            <i class='bx bx-plus' style="font-size: 0.85rem;"></i> Create
                        </button>
                    </div>
                    
                    <!-- Create Custom Tag Section -->
                    <div id="createTagSection" style="display: none;" class="mb-2 p-2 bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20 rounded border border-blue-200 dark:border-blue-800">
                        <input type="text" id="newTagName" placeholder="Tag name" class="w-full px-2 py-1 border border-blue-300 dark:border-blue-700 rounded dark:bg-gray-700 dark:text-white mb-1 text-xs" maxlength="20">
                        <input type="color" id="newTagColor" value="#3b82f6" class="w-full h-7 rounded cursor-pointer mb-1 border border-blue-200 dark:border-blue-700">
                        <div class="flex gap-1 text-xs">
                            <button type="button" onclick="createNewTag()" class="flex-1 px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs font-medium transition">
                                Add
                            </button>
                            <button type="button" onclick="toggleCreateTag()" class="flex-1 px-2 py-1 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-800 dark:text-white rounded text-xs font-medium transition">
                                Cancel
                            </button>
                        </div>
                    </div>
                    
                    <div id="tagsContainer" class="flex flex-wrap gap-1">
                        @foreach($tags as $tag)
                        <label class="flex items-center gap-1 px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded-full cursor-pointer hover:shadow transition duration-200 border-2 border-transparent hover:border-blue-300 dark:hover:border-blue-600">
                            <input type="checkbox" name="tags" value="{{ $tag->id }}" class="w-3 h-3 cursor-pointer">
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                        </label>
                        @endforeach
                    </div>
                    <div id="dynamicTagsContainer" class="flex flex-wrap gap-1"></div>
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-xs font-semibold text-gray-800 dark:text-gray-200 mb-1 flex items-center gap-1">
                        <i class='bx bx-note' style="color: #3b82f6;"></i>
                        Notes / Instructions
                    </label>
                    <textarea name="notes" rows="1" class="w-full px-3 py-1.5 border-2 border-gray-200 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-200 dark:focus:ring-blue-900 outline-none resize-none transition duration-200 text-sm" placeholder="Add any notes or instructions..."></textarea>
                </div>

                <!-- File Upload -->
                <div>
                    <label class="block text-xs font-semibold text-gray-800 dark:text-gray-200 mb-1 flex items-center gap-1">
                        <i class='bx bx-file-blank' style="color: #3b82f6;"></i>
                        Upload Files
                    </label>
                    <div class="border-2 border-dashed border-blue-300 dark:border-blue-700 bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20 rounded-lg p-3 text-center cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-900 dark:hover:bg-opacity-40 transition duration-200" onclick="document.getElementById('fileInput').click()">
                        <i class='bx bx-cloud-upload' style="font-size: 1.25rem; color: #3b82f6;"></i>
                        <p class="text-gray-700 dark:text-gray-300 mt-1 font-medium text-xs">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">JPG, PNG, PDF up to 10MB</p>
                    </div>
                    <input type="file" id="fileInput" name="files" multiple accept=".jpg,.jpeg,.png,.pdf" style="display: none;" onchange="addFilesToList()">
                    <div id="fileList" class="mt-1 space-y-0.5"></div>
                </div>

                <!-- Reminder -->
                <div>
                    <label class="flex items-center gap-2 text-xs font-semibold text-gray-800 dark:text-gray-200 mb-1 cursor-pointer">
                        <input type="checkbox" id="reminderToggle" onchange="toggleReminder()" class="w-3.5 h-3.5 cursor-pointer">
                        <i class='bx bx-bell' style="color: #3b82f6; font-size: 0.85rem;"></i>
                        Set a reminder for next visit
                    </label>
                    <div id="reminderSection" style="display: none;" class="space-y-1 p-2 bg-yellow-50 dark:bg-yellow-900 dark:bg-opacity-20 rounded border border-yellow-200 dark:border-yellow-800">
                        <input type="datetime-local" name="reminder_date" class="w-full px-3 py-1.5 border-2 border-yellow-300 dark:border-yellow-700 rounded dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring-1 focus:ring-yellow-200 dark:focus:ring-yellow-900 outline-none transition duration-200 text-sm">
                        <input type="text" name="reminder_note" class="w-full px-3 py-1.5 border-2 border-yellow-300 dark:border-yellow-700 rounded dark:bg-gray-700 dark:text-white focus:border-yellow-500 focus:ring-1 focus:ring-yellow-200 dark:focus:ring-yellow-900 outline-none transition duration-200 text-sm" placeholder="Reminder note (optional)">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-2 pt-3 border-t-2 dark:border-gray-700">
                    <button type="button" onclick="closeModal()" class="flex-1 px-3 py-1.5 border-2 border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold transition duration-200 text-xs">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 px-3 py-1.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-semibold transition duration-200 flex items-center justify-center gap-1 shadow-lg hover:shadow-xl text-xs">
                        <i class='bx bx-save' style="font-size: 0.9rem;"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('prescriptionModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('prescriptionModal').style.display = 'none';
            document.getElementById('prescriptionForm').reset();
            document.getElementById('fileList').innerHTML = '';
            document.getElementById('reminderSection').style.display = 'none';
            selectedFiles = [];
            currentEditingId = null;

            // Reset modal title
            document.querySelector('.prescription-modal-title').textContent = 'Add New Prescription';

            // Reset form submission to create
            const form = document.getElementById('prescriptionForm');
            form.onsubmit = async (e) => {
                e.preventDefault();
                // This will be handled by the main form submission event listener
            };
        }

        function toggleReminder() {
            const toggle = document.getElementById('reminderToggle').checked;
            document.getElementById('reminderSection').style.display = toggle ? 'block' : 'none';
        }

        // Store files separately to manage removals
        let selectedFiles = [];

        function addFilesToList() {
            const fileInput = document.getElementById('fileInput');
            
            // Add new files to the selected files array
            Array.from(fileInput.files).forEach(file => {
                const exists = selectedFiles.some(f => f.name === file.name && f.size === file.size);
                if (!exists) {
                    selectedFiles.push(file);
                }
            });

            renderFileList();
        }

        function removeFile(index) {
            selectedFiles.splice(index, 1);
            renderFileList();
        }

        function renderFileList() {
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center justify-between gap-2 px-3 py-2 bg-green-50 dark:bg-green-900 dark:bg-opacity-20 rounded border border-green-200 dark:border-green-800 hover:bg-green-100 dark:hover:bg-green-900 dark:hover:bg-opacity-30 transition duration-150';
                fileItem.innerHTML = `
                    <div class="flex items-center gap-2 flex-1 min-w-0">
                        <i class='bx bx-file' style="color: #10b981; font-size: 1.1rem; flex-shrink: 0;"></i>
                        <div class="flex-1 min-w-0">
                            <p class="text-gray-700 dark:text-gray-300 font-medium truncate text-xs">${file.name}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">${(file.size / 1024).toFixed(2)} KB</p>
                        </div>
                        <span class="text-green-600 dark:text-green-400 text-sm flex-shrink-0"><i class='bx bx-check-circle'></i></span>
                    </div>
                    <button type="button" onclick="removeFile(${index})" class="flex-shrink-0 px-2 py-1 bg-red-100 dark:bg-red-900 dark:bg-opacity-30 text-red-600 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-900 dark:hover:bg-opacity-50 rounded transition duration-150" title="Remove file">
                        <i class='bx bx-x' style="font-size: 1rem;"></i>
                    </button>
                `;
                fileList.appendChild(fileItem);
            });
        }

        function updateFileList() {
            const fileInput = document.getElementById('fileInput');
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';

            Array.from(fileInput.files).forEach(file => {
                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center gap-2 px-2 py-1 bg-green-50 dark:bg-green-900 dark:bg-opacity-20 rounded text-xs border border-green-200 dark:border-green-800';
                fileItem.innerHTML = `
                    <i class='bx bx-file' style="color: #10b981; font-size: 1rem;"></i>
                    <div class="flex-1 min-w-0">
                        <p class="text-gray-700 dark:text-gray-300 font-medium truncate text-xs">${file.name}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">${(file.size / 1024).toFixed(2)} KB</p>
                    </div>
                    <span class="text-green-600 dark:text-green-400 text-sm"><i class='bx bx-check-circle'></i></span>
                `;
                fileList.appendChild(fileItem);
            });
        }

        function toggleCreateTag() {
            const section = document.getElementById('createTagSection');
            section.style.display = section.style.display === 'none' ? 'block' : 'none';
        }

        function createNewTag() {
            const name = document.getElementById('newTagName').value.trim();
            const color = document.getElementById('newTagColor').value;

            if (!name) {
                showToast('Please enter a tag name', 'error');
                return;
            }

            const dynamicContainer = document.getElementById('dynamicTagsContainer');

            // Create a temporary ID for frontend display
            const tempId = 'temp_' + Date.now();

            // Create tag label element
            const label = document.createElement('label');
            label.className = 'flex items-center gap-1 px-2 py-1 rounded-full cursor-pointer hover:shadow transition duration-200 border-2 border-blue-300 text-xs';
            label.style.backgroundColor = color + '20';
            label.style.borderColor = color;
            label.innerHTML = `
                <input type="checkbox" name="tags" value="${tempId}" class="w-3 h-3 cursor-pointer">
                <span class="text-xs font-medium" style="color: ${color}">${name}</span>
            `;

            dynamicContainer.appendChild(label);
            document.getElementById('newTagName').value = '';
            toggleCreateTag();
            showToast('Tag created!', 'success');
        }

        document.getElementById('prescriptionForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // If in edit mode, use updatePrescription instead
            if (currentEditingId) {
                await updatePrescription(currentEditingId);
                return;
            }
            
            // Validate required fields
            const title = document.querySelector('input[name="title"]').value.trim();
            const prescriptionDate = document.querySelector('input[name="prescription_date"]').value;
            
            if (!title) {
                showToast('Please enter a prescription title', 'error');
                return;
            }
            
            if (!prescriptionDate) {
                showToast('Please select a prescription date', 'error');
                return;
            }
            
            const formData = new FormData(e.target);
            
            // Ensure tags is always an array
            const tagsCheckboxes = document.querySelectorAll('input[name="tags"]:checked');
            formData.delete('tags');
            tagsCheckboxes.forEach(checkbox => {
                formData.append('tags[]', checkbox.value);
            });
            
            // Add files from selectedFiles array
            selectedFiles.forEach((file) => {
                formData.append('files[]', file);
            });
            
            try {
                const response = await fetch('{{ route("prescription.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    showToast('Prescription saved successfully!', 'success');
                    closeModal();
                    location.reload();
                } else {
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat().join(', ');
                        showToast(errorMessages || 'Error saving prescription', 'error');
                    } else {
                        showToast(data.message || 'Error saving prescription', 'error');
                    }
                }
            } catch (error) {
                console.error(error);
                showToast('Error saving prescription', 'error');
            }
        });

        function selectPrescription(el, id) {
            // Remove active class from all cards
            document.querySelectorAll('.prescription-card').forEach(card => {
                card.classList.remove('active');
            });
            el.classList.add('active');

            // Hide main list and show detail
            document.getElementById('prescriptionList').style.display = 'none';
            document.getElementById('prescriptionDetail').classList.add('active');

            // Load prescription details
            loadPrescriptionDetail(id);
        }

        function backToPrescriptionList() {
            document.getElementById('prescriptionList').style.display = 'flex';
            const detailElement = document.getElementById('prescriptionDetail');
            detailElement.classList.add('closing');
            detailElement.style.transform = 'translateY(0)';
            setTimeout(() => {
                detailElement.classList.remove('active');
                detailElement.classList.remove('closing');
            }, 500);
            document.querySelectorAll('.prescription-card').forEach(card => {
                card.classList.remove('active');
            });
        }

        // Drag and hold functionality for prescription detail
        let detailDragStartY = 0;
        let detailCurrentY = 0;
        let detailIsDragging = false;
        let detailCanDrag = false;
        let detailDragVelocity = 0;
        let detailLastY = 0;
        let detailLastTime = 0;
        let detailHoldTimer = null;
        const HOLD_DELAY = 400; // 400ms hold time before dragging is enabled

        const prescriptionDetail = document.getElementById('prescriptionDetail');

        prescriptionDetail.addEventListener('touchstart', (e) => {
            if (window.innerWidth > 767) return; // Only on mobile
            detailDragStartY = e.touches[0].clientY;
            detailLastY = detailDragStartY;
            detailLastTime = Date.now();
            detailCanDrag = false;
            detailIsDragging = false;
            detailCurrentY = parseInt(prescriptionDetail.style.transform.match(/-?\d+/) || '0') || 0;
            
            // Set timer for hold detection
            detailHoldTimer = setTimeout(() => {
                detailCanDrag = true;
                prescriptionDetail.classList.add('dragging');
            }, HOLD_DELAY);
        }, false);

        prescriptionDetail.addEventListener('touchmove', (e) => {
            if (!detailCanDrag || window.innerWidth > 767) return;
            e.preventDefault();

            detailIsDragging = true;
            const currentY = e.touches[0].clientY;
            const deltaY = currentY - detailDragStartY;
            
            // Only allow dragging down (closing)
            if (deltaY > 0) {
                prescriptionDetail.style.transform = `translateY(${deltaY}px)`;
                
                // Calculate velocity
                const timeDelta = Date.now() - detailLastTime;
                if (timeDelta > 0) {
                    detailDragVelocity = (currentY - detailLastY) / timeDelta;
                }
                detailLastY = currentY;
                detailLastTime = Date.now();
            }
        }, { passive: false });

        prescriptionDetail.addEventListener('touchend', (e) => {
            if (window.innerWidth > 767) return;
            
            // Clear hold timer if touch ended before hold time
            if (detailHoldTimer) {
                clearTimeout(detailHoldTimer);
                detailHoldTimer = null;
            }

            if (!detailCanDrag) {
                detailIsDragging = false;
                return;
            }

            detailIsDragging = false;
            detailCanDrag = false;
            prescriptionDetail.classList.remove('dragging');

            const deltaY = parseInt(prescriptionDetail.style.transform.match(/-?\d+/) || '0') || 0;
            const threshold = window.innerHeight * 0.3;
            const shouldClose = deltaY > threshold || (detailDragVelocity > 0.5 && deltaY > 50);

            if (shouldClose) {
                prescriptionDetail.style.transform = `translateY(${window.innerHeight}px)`;
                setTimeout(() => {
                    backToPrescriptionList();
                }, 300);
            } else {
                prescriptionDetail.style.transform = 'translateY(0)';
                prescriptionDetail.classList.remove('dragging');
            }
        }, false);

        // Mouse support for desktop testing
        prescriptionDetail.addEventListener('mousedown', (e) => {
            if (window.innerWidth > 767) return;
            detailDragStartY = e.clientY;
            detailLastY = detailDragStartY;
            detailLastTime = Date.now();
            detailCanDrag = false;
            detailIsDragging = false;
            detailCurrentY = parseInt(prescriptionDetail.style.transform.match(/-?\d+/) || '0') || 0;
            
            // Set timer for hold detection
            detailHoldTimer = setTimeout(() => {
                detailCanDrag = true;
                prescriptionDetail.classList.add('dragging');
            }, HOLD_DELAY);
        }, false);

        document.addEventListener('mousemove', (e) => {
            if (!detailCanDrag || window.innerWidth > 767) return;

            detailIsDragging = true;
            const currentY = e.clientY;
            const deltaY = currentY - detailDragStartY;
            
            if (deltaY > 0) {
                prescriptionDetail.style.transform = `translateY(${deltaY}px)`;
                
                const timeDelta = Date.now() - detailLastTime;
                if (timeDelta > 0) {
                    detailDragVelocity = (currentY - detailLastY) / timeDelta;
                }
                detailLastY = currentY;
                detailLastTime = Date.now();
            }
        }, false);

        document.addEventListener('mouseup', (e) => {
            if (window.innerWidth > 767) return;
            
            // Clear hold timer if mouse up before hold time
            if (detailHoldTimer) {
                clearTimeout(detailHoldTimer);
                detailHoldTimer = null;
            }

            if (!detailCanDrag) {
                detailIsDragging = false;
                return;
            }

            detailIsDragging = false;
            detailCanDrag = false;
            prescriptionDetail.classList.remove('dragging');

            const deltaY = parseInt(prescriptionDetail.style.transform.match(/-?\d+/) || '0') || 0;
            const threshold = window.innerHeight * 0.3;
            const shouldClose = deltaY > threshold || (detailDragVelocity > 0.5 && deltaY > 50);

            if (shouldClose) {
                prescriptionDetail.style.transform = `translateY(${window.innerHeight}px)`;
                setTimeout(() => {
                    backToPrescriptionList();
                }, 300);
            } else {
                prescriptionDetail.style.transform = 'translateY(0)';
                prescriptionDetail.classList.remove('dragging');
            }
        }, false);

        let currentFileUrl = '';
        let currentFileName = '';
        let currentFileType = '';

        function openFilePreview(fileUrl, fileName, fileType) {
            currentFileUrl = fileUrl;
            currentFileName = fileName;
            currentFileType = fileType;
            currentZoom = 100;
            panX = 0;
            panY = 0;

            document.getElementById('filePreviewName').textContent = fileName;
            document.getElementById('filePreviewType').textContent = fileType === 'pdf' ? 'PDF Document' : 'Image File';
            document.getElementById('filePreviewModal').style.display = 'flex';
            document.getElementById('zoomLevel').textContent = '100%';

            const contentDiv = document.getElementById('filePreviewContent');
            contentDiv.innerHTML = '';

            if (fileType === 'pdf') {
                document.getElementById('filePreviewIcon').className = 'bx bx-file text-white text-xl';
                contentDiv.innerHTML = `<embed src="${fileUrl}" type="application/pdf" width="100%" height="100%" />`;
            } else {
                document.getElementById('filePreviewIcon').className = 'bx bx-image text-white text-xl';
                contentDiv.innerHTML = `<img src="${fileUrl}" alt="${fileName}" class="max-w-full max-h-96 object-contain" />`;
            }

            // Remove old event listeners if they exist
            contentDiv.removeEventListener('wheel', handleZoomScroll);
            contentDiv.removeEventListener('mousedown', startDrag);
            contentDiv.removeEventListener('mousemove', doDrag);
            contentDiv.removeEventListener('mouseup', stopDrag);
            contentDiv.removeEventListener('mouseleave', stopDrag);
            contentDiv.removeEventListener('touchstart', startDrag);
            contentDiv.removeEventListener('touchmove', doDrag);
            contentDiv.removeEventListener('touchend', stopDrag);

            // Add event listeners
            contentDiv.addEventListener('wheel', handleZoomScroll, { passive: false });
            contentDiv.addEventListener('mousedown', startDrag);
            contentDiv.addEventListener('mousemove', doDrag);
            contentDiv.addEventListener('mouseup', stopDrag);
            contentDiv.addEventListener('mouseleave', stopDrag);
            contentDiv.addEventListener('touchstart', startDrag);
            contentDiv.addEventListener('touchmove', doDrag, { passive: false });
            contentDiv.addEventListener('touchend', stopDrag);
        }

        function handleZoomScroll(event) {
            event.preventDefault();
            if (event.deltaY < 0) {
                zoomIn();
            } else {
                zoomOut();
            }
        }

        function closeFilePreview() {
            document.getElementById('filePreviewModal').style.display = 'none';
            document.getElementById('filePreviewContent').innerHTML = '';
            currentZoom = 100;
            panX = 0;
            panY = 0;
            isDragging = false;
            document.getElementById('zoomLevel').textContent = '100%';
        }

        let currentZoom = 100;
        let panX = 0;
        let panY = 0;
        let isDragging = false;
        let dragStartX = 0;
        let dragStartY = 0;
        let dragStartPanX = 0;
        let dragStartPanY = 0;
        const minZoom = 50;
        const maxZoom = 300;

        function zoomIn() {
            currentZoom = Math.min(currentZoom + 25, maxZoom);
            updateZoom();
        }

        function zoomOut() {
            currentZoom = Math.max(currentZoom - 25, minZoom);
            updateZoom();
        }

        function resetZoom() {
            currentZoom = 100;
            panX = 0;
            panY = 0;
            updateZoom();
        }

        function updateZoom() {
            const content = document.getElementById('filePreviewContent');
            const img = content.querySelector('img');
            const embed = content.querySelector('embed');

            document.getElementById('zoomLevel').textContent = currentZoom + '%';

            const transformValue = `scale(${currentZoom / 100}) translate(${panX}px, ${panY}px)`;

            if (img) {
                img.style.transform = transformValue;
                img.style.transition = isDragging ? 'none' : 'transform 0.2s ease-in-out';
                img.style.cursor = currentZoom > 100 ? 'grab' : 'default';
            }
            if (embed) {
                embed.style.transform = transformValue;
                embed.style.transformOrigin = 'top left';
                embed.style.transition = isDragging ? 'none' : 'transform 0.2s ease-in-out';
                embed.style.cursor = currentZoom > 100 ? 'grab' : 'default';
            }
        }

        function startDrag(e) {
            if (currentZoom <= 100) return;
            isDragging = true;
            dragStartX = e.clientX || e.touches?.[0]?.clientX;
            dragStartY = e.clientY || e.touches?.[0]?.clientY;
            dragStartPanX = panX;
            dragStartPanY = panY;
            
            const content = document.getElementById('filePreviewContent');
            if (content.querySelector('img')) {
                content.querySelector('img').style.cursor = 'grabbing';
            }
            if (content.querySelector('embed')) {
                content.querySelector('embed').style.cursor = 'grabbing';
            }
        }

        function doDrag(e) {
            if (!isDragging || currentZoom <= 100) return;
            e.preventDefault();
            
            const currentX = e.clientX || e.touches?.[0]?.clientX;
            const currentY = e.clientY || e.touches?.[0]?.clientY;
            
            const deltaX = currentX - dragStartX;
            const deltaY = currentY - dragStartY;
            
            panX = dragStartPanX + deltaX;
            panY = dragStartPanY + deltaY;
            
            updateZoom();
        }

        function stopDrag() {
            isDragging = false;
            const content = document.getElementById('filePreviewContent');
            if (content.querySelector('img')) {
                content.querySelector('img').style.cursor = 'grab';
            }
            if (content.querySelector('embed')) {
                content.querySelector('embed').style.cursor = 'grab';
            }
        }

        function downloadFile() {
            if (!currentFileUrl) return;
            const a = document.createElement('a');
            a.href = currentFileUrl;
            a.download = currentFileName || 'file';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            showToast('File downloaded successfully!', 'success');
        }

        function printFile() {
            if (!currentFileUrl) return;
            const printWindow = window.open(currentFileUrl, '_blank');
            if (printWindow) {
                printWindow.addEventListener('load', function() {
                    setTimeout(() => {
                        printWindow.print();
                    }, 250);
                });
            }
            showToast('Opening print dialog...', 'success');
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modal = document.getElementById('filePreviewModal');
                if (modal.classList.contains('active')) {
                    closeFilePreview();
                }
            }
        });

        // Close modal when clicking outside
        document.getElementById('filePreviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeFilePreview();
            }
        });

        async function loadPrescriptionDetail(id) {
            try {
                const response = await fetch(`/prescriptions/${id}`);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();

                if (data.success && data.prescription) {
                    const prescription = data.prescription;
                    const html = `
                        <div class="prescription-detail-header">
                            <div>
                                <h2 class="prescription-detail-title">${prescription.title}</h2>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
                                    ${new Date(prescription.prescription_date).toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'})}
                                </p>
                            </div>
                            <div class="btn-group">
                                <button class="btn-small btn-primary-small" onclick="editPrescription(${id})">
                                    <i class='bx bx-edit'></i> Edit
                                </button>
                                <button class="btn-small btn-danger-small" onclick="deletePrescription(${id})">
                                    <i class='bx bx-trash'></i> Delete
                                </button>
                            </div>
                        </div>

                        ${prescription.next_visit_date && new Date(prescription.next_visit_date) > new Date() ? `
                            <div class="upcoming-reminder">
                                <div class="reminder-text">
                                    <i class='bx bx-calendar'></i> Next visit: ${new Date(prescription.next_visit_date).toLocaleDateString()}
                                </div>
                            </div>
                        ` : ''}

                        <div class="detail-section">
                            <div class="detail-label">Doctor / Hospital</div>
                            <div class="detail-value">${prescription.doctor_name || 'Not specified'}</div>
                        </div>

                        ${prescription.tags && prescription.tags.length > 0 ? `
                            <div class="detail-section">
                                <div class="detail-label">Tags</div>
                                <div class="flex flex-wrap gap-2">
                                    ${prescription.tags.map(tag => `
                                        <span class="prescription-card-tag" style="background-color: ${tag.color || '#3b82f6'}">
                                            ${tag.name}
                                        </span>
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}

                        ${prescription.notes ? `
                            <div class="detail-section">
                                <div class="detail-label">Notes</div>
                                <div class="detail-value">${prescription.notes}</div>
                            </div>
                        ` : ''}

                        ${prescription.files && prescription.files.length > 0 ? `
                            <div class="detail-section">
                                <div class="detail-label">Attached Files</div>
                                <div class="file-preview">
                                    ${prescription.files.map(file => `
                                        <a href="javascript:void(0)" class="file-item" onclick="openFilePreview('${file.file_url || ''}', '${file.original_name || 'File'}', '${file.file_type || 'unknown'}')">
                                            <span class="file-icon">
                                                ${file.file_type === 'pdf' ? '📄' : '🖼️'}
                                            </span>
                                            <span>${file.original_name || 'File'}</span>
                                        </a>
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}
                    `;

                    document.getElementById('detailContent').innerHTML = html;
                } else {
                    showToast('Error loading prescription details', 'error');
                }
            } catch (error) {
                console.error('Error loading prescription:', error);
                showToast('Error loading prescription details: ' + error.message, 'error');
            }
        }

        let currentEditingId = null;

        async function editPrescription(id) {
            try {
                // Fetch the prescription data
                const response = await fetch(`/prescriptions/${id}`);
                const data = await response.json();

                if (!data.success) {
                    showToast('Error loading prescription for edit', 'error');
                    return;
                }

                const prescription = data.prescription;
                currentEditingId = id;

                // Update modal title
                document.querySelector('.prescription-modal-title').textContent = 'Edit Prescription';

                // Fill form with existing data
                document.querySelector('input[name="title"]').value = prescription.title || '';
                document.querySelector('input[name="prescription_date"]').value = prescription.prescription_date || '';
                document.querySelector('input[name="next_visit_date"]').value = prescription.next_visit_date || '';
                document.querySelector('input[name="doctor_name"]').value = prescription.doctor_name || '';
                document.querySelector('textarea[name="notes"]').value = prescription.notes || '';

                // Reset and select tags
                document.querySelectorAll('input[name="tags"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
                if (prescription.tags && prescription.tags.length > 0) {
                    prescription.tags.forEach(tag => {
                        const checkbox = document.querySelector(`input[name="tags"][value="${tag.id}"]`);
                        if (checkbox) {
                            checkbox.checked = true;
                        }
                    });
                }

                // Clear files list
                selectedFiles = [];
                renderFileList();

                // Update form submission to edit instead of create
                const form = document.getElementById('prescriptionForm');
                form.onsubmit = async (e) => {
                    e.preventDefault();
                    await updatePrescription(id);
                };

                // Open modal
                document.getElementById('prescriptionModal').style.display = 'flex';
            } catch (error) {
                console.error('Error loading prescription for edit:', error);
                showToast('Error loading prescription for edit', 'error');
            }
        }

        async function updatePrescription(id) {
            // Validate required fields
            const title = document.querySelector('input[name="title"]').value.trim();
            const prescriptionDate = document.querySelector('input[name="prescription_date"]').value;
            
            if (!title) {
                showToast('Please enter a prescription title', 'error');
                return;
            }
            
            if (!prescriptionDate) {
                showToast('Please select a prescription date', 'error');
                return;
            }
            
            const formData = new FormData();
            formData.append('title', title);
            formData.append('doctor_name', document.querySelector('input[name="doctor_name"]').value);
            formData.append('prescription_date', prescriptionDate);
            formData.append('next_visit_date', document.querySelector('input[name="next_visit_date"]').value);
            formData.append('notes', document.querySelector('textarea[name="notes"]').value);
            
            // Ensure tags is always an array
            const tagsCheckboxes = document.querySelectorAll('input[name="tags"]:checked');
            tagsCheckboxes.forEach(checkbox => {
                formData.append('tags[]', checkbox.value);
            });
            
            // Add new files from selectedFiles array
            selectedFiles.forEach((file) => {
                formData.append('files[]', file);
            });
            
            try {
                const response = await fetch(`/prescriptions/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    showToast('Prescription updated successfully!', 'success');
                    closeModal();
                    currentEditingId = null;
                    location.reload();
                } else {
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat().join(', ');
                        showToast(errorMessages || 'Error updating prescription', 'error');
                    } else {
                        showToast(data.message || 'Error updating prescription', 'error');
                    }
                }
            } catch (error) {
                console.error(error);
                showToast('Error updating prescription', 'error');
            }
        }

        async function deletePrescription(id) {
            if (!confirm('Are you sure you want to delete this prescription?')) return;

            try {
                const response = await fetch(`/prescriptions/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showToast('Prescription deleted successfully!', 'success');
                    location.reload();
                } else {
                    showToast(data.message || 'Error deleting prescription', 'error');
                }
            } catch (error) {
                console.error(error);
                showToast('Error deleting prescription', 'error');
            }
        }

        function filterPrescriptions() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.prescription-card');

            cards.forEach(card => {
                const title = card.querySelector('.prescription-card-title').textContent.toLowerCase();
                const meta = card.querySelector('.prescription-card-meta').textContent.toLowerCase();
                const visible = title.includes(search) || meta.includes(search);
                card.style.display = visible ? '' : 'none';
            });
        }

        function filterByTag(tagId, button) {
            button.classList.toggle('active');
            applyFilters();
        }

        function applyFilters() {
            const activeTags = Array.from(document.querySelectorAll('.tag-chip.active')).map(btn => btn.dataset.tagId);
            const cards = document.querySelectorAll('.prescription-card');

            cards.forEach(card => {
                const cardTags = Array.from(card.querySelectorAll('.prescription-card-tag')).map((tag, idx) => {
                    // Get the tag ID from the data attribute or by matching tag names
                    return card.dataset.prescriptionId + '-' + idx;
                });

                if (activeTags.length === 0) {
                    card.style.display = '';
                } else {
                    const hasActiveTag = cardTags.some(tag => activeTags.includes(tag));
                    card.style.display = hasActiveTag ? '' : 'none';
                }
            });
        }

        function sortPrescriptions(sortBy) {
            const prescriptionList = document.getElementById('prescriptionList');
            const cards = Array.from(prescriptionList.querySelectorAll('.prescription-card'));

            // Sort cards based on selected option
            cards.sort((a, b) => {
                const dateA = new Date(a.dataset.prescriptionDate || 0);
                const dateB = new Date(b.dataset.prescriptionDate || 0);

                switch(sortBy) {
                    case 'newest':
                        return dateB - dateA;
                    case 'oldest':
                        return dateA - dateB;
                    case 'upcoming':
                        // Sort by next visit date (closest upcoming first)
                        const nextVisitA = new Date(a.dataset.nextVisitDate || '9999-12-31');
                        const nextVisitB = new Date(b.dataset.nextVisitDate || '9999-12-31');
                        return nextVisitA - nextVisitB;
                    default:
                        return 0;
                }
            });

            // Clear and re-append sorted cards with smooth animation
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(10px)';
                prescriptionList.appendChild(card);
                
                setTimeout(() => {
                    card.style.transition = 'all 0.3s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 50);
            });
        }

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : '#ef4444'};
                color: white;
                padding: 16px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 9999;
                display: flex;
                align-items: center;
                gap: 12px;
                font-size: 14px;
                animation: slideIn 0.3s ease-out;
            `;
            toast.innerHTML = `
                <i class='bx ${type === 'success' ? 'bx-check-circle' : 'bx-error-circle'}' style="font-size: 20px;"></i>
                <span>${message}</span>
            `;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Keyboard shortcut for modal
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
                backToPrescriptionList();
            }
        });

        // Initialize sorting on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Set default sort to newest first
            const sortSelect = document.querySelector('.sort-select');
            if (sortSelect && sortSelect.value === 'newest') {
                sortPrescriptions('newest');
            }
        });
    </script>
            </div>
        </div>
    </div>
</x-app-layout>
