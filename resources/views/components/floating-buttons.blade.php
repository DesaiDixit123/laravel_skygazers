<div class="floating-buttons">
    <a href="tel:+917579410617" class="btn-float btn-call" title="Call Us">
        <i class="fas fa-phone"></i>
    </a>
    <a href="mailto:Admin@skygazers.in" class="btn-float btn-email" title="Email Us">
        <i class="fas fa-envelope"></i>
    </a>
    <a href="https://wa.me/917579410617" class="btn-float btn-whatsapp" title="WhatsApp Us">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>

<style>
    .floating-buttons {
        position: fixed;
        right: 30px;
        bottom: 30px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        z-index: 2000;
    }

    .btn-float {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        font-size: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .btn-float:hover {
        transform: scale(1.1);
    }

    .btn-call {
        background-color: #3b5998; /* Example blue */
    }

    .btn-email {
        background-color: #007bff; /* Example mail blue */
    }

    .btn-whatsapp {
        background-color: #25d366; /* WhatsApp Green */
    }

    @media (max-width: 768px) {
        .floating-buttons {
            right: 15px;
            bottom: 15px;
        }
        
        .btn-float {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
    }
</style>
