@extends('layouts.marketing')

@section('content')
<div class="breadcrumb-area bg-f round-20 position-relative z-1">
    <div class="container text-center">
        <ul class="br-menu text-center bg_secondary d-inline-block list-unstyled mb-15">
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">
                <a href="{{ url('/') }}">HOME</a>
            </li>
            <li class="position-relative fs-13 fw-semibold ls-1 d-inline-block">CONTACT</li>
        </ul>
        <h2 class="section-title style-one fw-medium font-secondary text-black text-center mb-6">
            Contact
        </h2>
    </div>
</div>

<section class="pt-100 pb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white round-10 p-40 text-center">
                    <h3 class="font-secondary fw-semibold mb-15">Hubungi Kami</h3>
                    <p class="text-muted mb-30">
                        Halaman kontak belum dihubungkan ke inbox atau workflow pengiriman pesan.
                        Untuk saat ini, gunakan informasi kontak yang tampil di footer.
                    </p>
                    <a href="{{ url('/') }}" class="btn style-two fw-semibold position-relative round-oval">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
