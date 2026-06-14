@extends('layouts.twins')

@push('styles')
<style>
    /* Contact page styles */
    .contact-page{ padding:15px 30px 80px; background:#fff }
    .contact-header{ text-align:center; margin-bottom:50px }
    .contact-header h1{ font-size:58px; font-weight:800; color:#111; margin-bottom:15px; line-height:1.1 }
    .contact-header p{ max-width:750px; margin:0 auto; color:#666; font-size:18px; line-height:1.8 }
    .contact-container{ max-width:1400px; margin:auto }
    .contact-row{ display:flex; justify-content:center; gap:30px; margin-bottom:30px }
    .contact-card{ width:380px; min-height:260px; background:#fff; border:1px solid #ececec; border-radius:18px; padding:40px 30px; text-align:center; transition:.3s }
    .contact-card:hover{ transform:translateY(-8px); box-shadow:0 12px 30px rgba(0,0,0,.08) }
    .contact-card i{ font-size:42px; margin-bottom:20px }
    .contact-card h3{ font-size:22px; font-weight:700; margin-bottom:15px }
    .contact-card p{ font-size:17px; line-height:1.8; color:#666 }
    .center-row{ justify-content:center }
    .contact-card .fa-location-dot{ color:#EF4444 }
    .contact-card .fa-phone{ color:#00ac3f }
    .contact-card .fa-envelope{ color:#3B82F6 }
    .contact-card .fa-instagram{ color:#ff00b3 }
    .contact-card .fa-clock{ color:#F59E0B }
    @media (max-width:992px){ .contact-header h1{ font-size:48px } .contact-card{ min-height:auto } }
    @media (max-width:768px){ .contact-page{ padding:20px 20px 60px } .contact-header h1{ font-size:40px } .contact-header p{ font-size:16px } .contact-card{ padding:30px 20px } }
</style>
@endpush

@section('content')
    <section class="contact-page">
        <div class="contact-header align-with-search">
            <h1>Kontak Kami</h1>
            <p>Kami siap membantu Anda jika memiliki pertanyaan, membutuhkan rekomendasi produk, atau ingin mengetahui informasi lebih lanjut.</p>
        </div>

        <div class="contact-container">
            <a href="https://maps.google.com/?q=Jl.H.Hasan+No.12+Pasar+Rebo+Jakarta" target="_blank"
                    class="maps-link">
            <div class="contact-row">
                <div class="contact-card">
                    <i class="fa-solid fa-location-dot"></i>
                    <h3>Alamat</h3>
                    <p>Jl. H. Hasan No.12 RT.31/RW.9, Baru, Kec. Ps. Rebo, Kota Jakarta Timur, DKI Jakarta 13780</p>
                </a>    
                </div>

                <div class="contact-card">
                    <a href="https://wa.me/6287743114125" target="_blank" rel="noopener noreferrer">
                    <i class="fa-solid fa-phone"></i>
                    <h3>Telepon / WhatsApp</h3>
                    <p>0877-4311-4125</p>
                    </a>
                </div>

                <div class="contact-card">
                    <a href="mailto:twinsvapor.shop@gmail.com">
                    <i class="fa-solid fa-envelope"></i>
                    <h3>Email</h3>
                    <p>twinsvapor.shop@gmail.com</p>
                    </a>
                </div>
            </div>

            <div class="contact-row center-row">
                <a href="https://instagram.com/twins.vaporshop" target="_blank" rel="noopener noreferrer">
                <div class="contact-card">
                    <i class="fa-brands fa-instagram"></i>
                    <h3>Instagram</h3>
                    <p>@twins.vaporshop</p>
                </div>
                </a>

                <div class="contact-card">
                    <i class="fa-solid fa-clock"></i>
                    <h3>Jam Operasional</h3>
                    <p>Senin - Minggu<br>10.30 - 23.00 WIB</p>
                </div>
            </div>
        </div>
    </section>
@endsection
