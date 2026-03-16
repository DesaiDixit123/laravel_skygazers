<section id="models" class="models-section">
    <div class="container">
        <h2 class="section-title-dark">Our Models</h2>
        
        <div class="model-filters">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="female">Female</button>
            <button class="filter-btn" data-filter="male">Male</button>
        </div>

        <div class="models-grid">
            @php
                $models = [
                    ['name' => 'APEKSHA', 'gender' => 'Female', 'image' => 'model_1.png', 'category' => 'female'],
                    ['name' => 'AAGAZ', 'gender' => 'Male', 'image' => 'model_2.png', 'category' => 'male'],
                    ['name' => 'ABHISHEK', 'gender' => 'Male', 'image' => 'model_2.png', 'category' => 'male'],
                    ['name' => 'JAYATI', 'gender' => 'Female', 'image' => 'model_1.png', 'category' => 'female'],
                    ['name' => 'AYAAN', 'gender' => 'Male', 'image' => 'model_2.png', 'category' => 'male'],
                    ['name' => 'SWECHCHHA', 'gender' => 'Female', 'image' => 'model_1.png', 'category' => 'female'],
                    ['name' => 'AKSHAY N', 'gender' => 'Male', 'image' => 'model_2.png', 'category' => 'male'],
                    ['name' => 'VARUN S', 'gender' => 'Male', 'image' => 'model_2.png', 'category' => 'male'],
                ];
            @endphp

            @foreach($models as $model)
                <div class="model-card" data-category="{{ $model['category'] }}">
                    <div class="model-image-wrapper">
                        <img src="{{ asset('images/' . $model['image']) }}" alt="{{ $model['name'] }}">
                        <div class="model-overlay">
                            <span class="model-gender">{{ $model['gender'] }}</span>
                            <h4 class="model-name">{{ $model['name'] }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="view-more-container">
            <a href="#" class="btn-view-more">View More</a>
        </div>
    </div>
</section>

<style>
    .models-section {
        background-color: #1a1a1a;
        color: #ffffff;
        padding: 80px 0;
    }

    .section-title-dark {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        text-align: center;
        margin-bottom: 40px;
        letter-spacing: 2px;
    }

    .model-filters {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-bottom: 50px;
    }

    .filter-btn {
        background: none;
        border: none;
        color: rgba(255,255,255,0.6);
        font-size: 14px;
        cursor: pointer;
        padding: 5px 0;
        position: relative;
        transition: color 0.3s ease;
    }

    .filter-btn.active, .filter-btn:hover {
        color: #ffffff;
    }

    .filter-btn.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #ffffff;
    }

    .models-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .model-card {
        position: relative;
        overflow: hidden;
        aspect-ratio: 4 / 5;
        transition: transform 0.5s ease, opacity 0.5s ease;
    }

    .model-image-wrapper {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .model-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: transform 0.8s ease, filter 0.5s ease;
    }

    .model-card:hover .model-image-wrapper img {
        transform: scale(1.1);
        filter: grayscale(0%);
    }

    .model-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 30px 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        pointer-events: none;
    }

    .model-gender {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255,255,255,0.7);
        display: block;
        margin-bottom: 5px;
    }

    .model-name {
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 1px;
        margin: 0;
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

    @media (max-width: 768px) {
        .models-grid {
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const modelCards = document.querySelectorAll('.model-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active state
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.getAttribute('data-filter');

                // Filter logic
                modelCards.forEach(card => {
                    if (filter === 'all' || card.getAttribute('data-category') === filter) {
                        card.style.display = 'block';
                        setTimeout(() => card.style.opacity = '1', 10);
                    } else {
                        card.style.opacity = '0';
                        setTimeout(() => card.style.display = 'none', 500);
                    }
                });
            });
        });
    });
</script>
