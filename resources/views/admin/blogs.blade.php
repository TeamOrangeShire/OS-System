@if (session()->has('Admin_id'))
    <!DOCTYPE html>
    <html lang="en">

    <head>
        @include('admin.assets.header', ['title' => 'Blogs'])

        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet" />
    </head>

    <body class="">
        <div class="lds-roller" id="roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <!-- [ Pre-loader ] End -->
        <!-- [ navigation menu ] start -->
        @include('admin.component.nav')
        <!-- [ navigation menu ] end -->
        <!-- [ Header ] start -->
        @include('admin.component.header')
        <!-- [ Header ] end -->



        <!-- [ Main Content ] start -->
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                <!-- [ Main Content start ] start -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Basic Alerts</h5>
                            <button class="btn btn-primary" data-bs-toggle='modal' data-bs-target='#out'>Button</button>
                        </div>
                        <div class="card-body">

                            <div class="row" id="blogCard">



                            </div>

                        </div>
                    </div>
                </div>

                {{-- modal start info --}}
                <div id="out" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Blog Content</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="addnewblog" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="">Blog Title</label>
                                            <input type="text" id="title" name="title" class="form-control">
                                            <input type="hidden" name="content" id="content">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Category</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="Entertainment">Entertainment</option>
                                                <option value="Informative">Informative</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="">Blog Cover</label>
                                            <input type="file" id="image" name="image" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="">Blog Content</label>
                                            <div id="editor" style="height: auto;"></div>
                                        </div>

                                    </div>
                                    <button type="button" class="btn btn-primary mt-3"
                                        onclick="insertContent()">Display Content</button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end info --}}
                {{-- modal start info --}}
                <div id="viewBlog" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Blog Content</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" id="addnewblog" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="">Blog Title</label>
                                            <input type="text" id="title2" name="title" class="form-control">
                                            <input type="hidden" name="blog_id" id="blog_id">
                                            <input type="hidden" name="content" id="content2">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Category</label>
                                            <select name="category" id="category2" class="form-control">
                                                <option value="Entertainment">Entertainment</option>
                                                <option value="Informative">Informative</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="">Blog Cover</label>
                                            <input type="file" id="image2" name="image"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="">Blog Content</label>
                                            <div id="editor2" style="height: auto;"></div>
                                        </div>

                                    </div>
                                    <button type="button" class="btn btn-primary mt-3"
                                        onclick="EditContent()">Display Content</button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- modal end info --}}
                <!-- [ Main Content ] end -->
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.js"></script>
        <script>
            const quill = new Quill('#editor', {
                theme: 'snow',
                formats: [
                    'header', 'bold', 'italic', 'underline', 'strike', 'blockquote',
                    'list', 'indent', 'link'
                ],
                modules: {
                    toolbar: [
                        [{
                            'header': [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{
                            'list': 'ordered'
                        }],
                        [{
                            'indent': '-1'
                        }, {
                            'indent': '+1'
                        }],

                        ['clean']
                    ]
                }
            });

            function insertContent() {
                const title = document.getElementById('title').value;
                const category = document.getElementById('category').value;
                var content = quill.root.innerHTML;

                // Create FormData object
                var formData = new FormData();
                formData.append('title', title);
                formData.append('content', content);
                formData.append('category', category);
                formData.append('image', $('#image')[0].files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    type: "POST",
                    url: "{{ route('AddBlog') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response.data);
                        $('#blogCard').empty();
                        GetBlog();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            $(document).ready(function() {
                GetBlog();
            });

            function GetBlog() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('GetBlog') }}",
                    success: function(response) {
                        // Loop through each blog entry in response.data
                        response.data.forEach(function(blogEntry) {

                            const image = "{{ asset('User/Admin/') }}/" + blogEntry.blog_picture;

                            var cardDiv = $(
                                '<div class="col-md-4 mb-3">' +
                                '<div class="card">' +
                                '<img class="card-img-top" src="' + image + '" alt="Card">' +
                                '<div class="card-body">' +
                                '<h5 class="card-title">' + blogEntry.blog_title + '</h5>' +
                                '<p class="card-text">' + blogEntry.blog_content + '</p>' +
                                '<div class="d-flex justify-content-between">' +
                                // Added container for buttons
                                '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewBlog" onclick="viewBlog(' +
                                blogEntry.blog_id + ')">Edit</button>' +
                                '<button class="btn btn-danger">Delete</button>' +
                                '</div>' + // Close button container
                                '</div>' +
                                '</div>' +
                                '</div>'
                            );


                            // Append the newly created div to an existing element with id="blogCard"
                            $('#blogCard').append(cardDiv);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            let quill2;

            function viewBlog(id) {
                console.log(id);
                $.ajax({
                    type: "GET",
                    url: "{{ route('GetBlogEdit') }}?blog_id=" + id,
                    success: function(response) {
                        console.log(response.data);

                        var responseData = response.data;
                        responseData.forEach(function(blog) {
                            document.getElementById('blog_id').value = blog.blog_id;
                            document.getElementById('title2').value = blog.blog_title;
                            document.getElementById('category2').value = blog.blog_category;
                            quill2 = refreshQuill(quill2);
                            quill2.root.innerHTML = '';
                            quill2.root.innerHTML = blog.blog_content;
                        });

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });


                function refreshQuill(quillInstance) {

                    if (quillInstance instanceof Quill) {
                        quillInstance.root.innerHTML = '';
                        quillInstance.setContents([{
                            insert: '\n'
                        }]);
                        return quillInstance;
                    }

                    // Reinitialize Quill
                    quillInstance = new Quill('#editor2', {
                        theme: 'snow',
                        formats: [
                            'header', 'bold', 'italic', 'underline', 'strike', 'blockquote',
                            'list', 'indent', 'link'
                        ],
                        modules: {
                            toolbar: [
                                [{
                                    'header': [1, 2, false]
                                }],
                                ['bold', 'italic', 'underline', 'strike'],
                                ['blockquote', 'code-block'],
                                [{
                                    'list': 'ordered'
                                }],
                                [{
                                    'indent': '-1'
                                }, {
                                    'indent': '+1'
                                }],
                                ['clean']
                            ]
                        }
                    });

                    return quillInstance;
                }


                quill2 = refreshQuill(quill2);
            }

            function EditContent() {
                const blog_id = document.getElementById('blog_id').value;
                const title = document.getElementById('title2').value;
                const category = document.getElementById('category2').value;
                var content = quill2.root.innerHTML;

                // Create FormData object
                var formData = new FormData();
                formData.append('blog_id', blog_id);
                formData.append('title', title);
                formData.append('content', content);
                formData.append('category', category);
                formData.append('image', $('#image2')[0].files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    type: "POST",
                    url: "{{ route('EditBlog') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response.data);
                        $('#blogCard').empty();
                        GetBlog();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>
        <!-- [ Main Content ] end -->
        <!-- Required Js -->
        @include('admin.assets.adminscript')


    </body>

    </html>
@else
    @php
        echo '<script>
            window.location.href = "login";
        </script>';
    @endphp
@endif
