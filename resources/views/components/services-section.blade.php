@props(['services' => [], 'showViewAll' => true])

<section id="services" class="services-section">
    <div class="container">
        <h2 class="section-title-dark">Our Services</h2>
        
        <div class="services-grid">

            @foreach($services as $service)
                <div class="service-card">
                    <div class="service-image-wrapper">
                        @if($service->image)
                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}">
                        @else
                            <img src="{{ asset('images/service_influencer.png') }}" alt="{{ $service->title }}">
                        @endif
                        <div class="service-overlay">
                            <h4 class="service-title">{{ $service->title }}</h4>
                            <p class="service-summary">{{ $service->summary }}</p>
                        </div>
                    </div>
                    <div class="service-details">
                        <div class="service-description">{!! $service->description !!}</div>
                        <ul class="service-benefits">
                            @if(is_array($service->benefits) || is_object($service->benefits))
                                @foreach($service->benefits as $benefit)
                                    <li><i class="fas fa-check"></i> {{ $benefit }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>

        @if($showViewAll ?? true)
        <div class="view-more-container">
            <a href="{{ url('/services') }}" class="btn-view-more">View All Services</a>
        </div>
        @endif
    </div>
</section>

<style>
    .services-section {
        background-color: #111111;
        color: #ffffff;
        padding: 100px 0;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    @media (max-width: 768px) {
        .services-section {
            padding: 60px 0;
        }

        .section-title-dark {
            font-size: clamp(26px, 8vw, 32px);
            padding: 0 15px;
        }

        .services-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 0 15px;
        }
    }

    .view-more-container {
        text-align: center;
        margin-top: 60px;
    }

    .btn-view-more {
        display: inline-block;
        border: 1px solid #ffffff;
        color: #ffffff;
        padding: 12px 40px;
        border-radius: 25px;
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-view-more:hover {
        background-color: #ffffff;
        color: #000000;
    }

    .service-card {
        background-color: #1a1a1a;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-10px);
    }

    .service-image-wrapper {
        position: relative;
        aspect-ratio: 16 / 9;
        overflow: hidden;
    }

    .service-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.6;
        transition: transform 0.5s ease;
    }

    .service-card:hover .service-image-wrapper img {
        transform: scale(1.1);
        opacity: 0.8;
    }

    .service-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
    }

    .service-title {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        margin-bottom: 5px;
    }

    .service-summary {
        font-size: 12px;
        color: rgba(255,255,255,0.7);
        margin: 0;
    }

    .service-details {
        padding: 25px;
    }

    .service-description {
        font-size: 14px;
        line-height: 1.6;
        color: rgba(255,255,255,0.8);
        margin-bottom: 20px;
    }

    .service-benefits {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .service-benefits li {
        font-size: 13px;
        color: rgba(255,255,255,0.6);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .service-benefits i {
        font-size: 10px;
        color: #ffffff;
    }
</style>
