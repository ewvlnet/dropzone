@props(['model' => ''])

<div class="owl-carousel owl-theme carouselOneItem">
    @forelse($model->files as $file)
        <div class="item">
            <img class="post_page_cover" alt="{{$model->name}}" title="{{$model->name}}"
                 src="{{ url('/storage/'.$file->url) }}"/>
        </div>
    @empty
    @endforelse
</div>

@push('css')
    {{-- If you are already loading jquery in your main layout, this is not necessary --}}
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <style>
        /*Recommended dimensions 780x520*/
        .carouselOneItem .item img {
            border-radius: 12px;
            max-width: 70%;
            max-height: 520px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            /*Recommended dimensions 360x240*/
            .carouselOneItem .item img {
                max-width: 100%;
                max-height: 240px;
            }
        }
    </style>
@endpush
@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $('.owl-carousel.carouselOneItem').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            items: 1,
        });
    </script>
@endpush
