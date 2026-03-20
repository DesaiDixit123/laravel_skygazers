<section class="brands-section">
    <div class="container">
        <h2 class="section-title-light">TRUSTED BY GLOBAL BRANDS</h2>
        
        <div class="brands-grid">
            <div class="brand-item">
                <span class="brand-dummy">TANISHQ</span>
            </div>
            <div class="brand-item">
                <span class="brand-dummy green">Knorr</span>
            </div>
            <div class="brand-item">
                <span class="brand-dummy blue">VW</span>
            </div>
            <div class="brand-item">
                <span class="brand-dummy navy">HYUNDAI</span>
            </div>
            <div class="brand-item">
                <span class="brand-dummy serif">CARATLANE</span>
            </div>
            <div class="brand-item">
                <span class="brand-dummy red">Mahindra</span>
            </div>
        </div>
    </div>
</section>

<style>
    .brands-section {
        background-color: #f9f9f9;
        color: #000000;
        padding: 80px 0;
        text-align: center;
    }

    .section-title-light {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 50px;
    }

    .brands-grid {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 60px;
        flex-wrap: wrap;
    }

    .brand-item {
        opacity: 0.8;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .brand-item:hover {
        opacity: 1;
    }

    .brand-dummy {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 2px;
        color: #333;
    }

    .brand-dummy.green { color: #006837; }
    .brand-dummy.blue { color: #001e50; }
    .brand-dummy.navy { color: #002c5f; }
    .brand-dummy.serif { font-family: 'Playfair Display', serif; font-weight: 400; }
    .brand-dummy.red { color: #ed1c24; }

    @media (max-width: 768px) {
        .brands-grid {
            gap: 30px;
        }
        .section-title-light {
            font-size: 24px;
        }
    }

    @media (max-width: 530px) {
        .brands-grid {
            gap: 12px;
        }
        .brand-dummy {
            font-size: 16px;
        }
        .brands-section {
            padding: 40px 0;
        }
        .section-title-light {
            font-size: 20px;
            margin-bottom: 30px;
        }
    }
</style>
