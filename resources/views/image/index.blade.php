@extends('master')

@section('js-lib')
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
@endsection

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="grid">
                @foreach($list as $item)
                    <div class="item"><img src="{{ $item->image_url }}"></div>
                @endforeach
            </div>

        </div><!-- /.blog-main -->
    </div><!-- /.row -->
@endsection
@section('js')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            let Image = function () {
                this.total = parseInt('{{ $total }}');  //总图片数
                this.page = 1;  //页码
                this.pageSize = 15; //每页显示条数
                this.gridContainer = $('.grid');
                this.newItemHtml = '<div class="item"><img src="%url%"></div>';
                this.modelId = parseInt('{{ $modelId }}');
                this.loading = false;
            };

            Image.prototype = {
                init: function () {
                    this.gridContainer.isotope({
                        itemSelector: '.item',
                        layoutMode: 'masonry'
                    });
                    let that = this
                    this.gridContainer.imagesLoaded().progress(function () {
                        that.gridContainer.isotope('layout');
                    });

                    window.addEventListener('scroll', function () {
                        that.onWindowScroll(that)
                    })
                },

                onWindowScroll: function (that) {
                    let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                    let windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
                    let scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
                    if (scrollTop + windowHeight >= scrollHeight) {
                        if (that.loading === false && Math.ceil(that.total / that.pageSize) > that.page) {
                            that.page++
                            that.fetchImage()
                        }
                    }
                },
                fetchImage: function () {
                    let that = this
                    that.loading = true
                    $.ajax({
                        url: '{{ route('image.list') }}',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            page: this.page,
                            pageSize: this.pageSize,
                            model_id: this.modelId
                        },
                        success: function (result) {
                            if (result.code === 200) {
                                that.total = result.data.total;
                                let list = result.data.list;
                                let appendHtml = '';
                                for (let i in list) {
                                    appendHtml += that.newItemHtml.replace('%url%', list[i].image_url);
                                }

                                that.gridContainer.append(appendHtml)
                                that.gridContainer.isotope('reloadItems').isotope();
                                that.gridContainer.imagesLoaded().progress(function () {
                                    that.gridContainer.isotope('layout');
                                });
                            }
                        },
                    }).always(function (){
                        that.loading = false
                    })
                }
            }

            let image = new Image()
            image.init();
        });
    </script>
@endsection
