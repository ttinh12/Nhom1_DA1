<?php
// lấy id bài viết
$id = $_GET['id'] ?? 0;

// load DB
require_once "Model/Database.php";
$db = new Database();
$conn = $db->connect();

// lấy bài viết
$sql = "SELECT * FROM blogs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

// nếu không có
if (!$blog) {
    echo "Không tìm thấy bài viết";
    return;
}
?>

<section class="blog-hero spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-9 text-center">
                <div class="blog__hero__text">

                    <!-- TITLE -->
                    <h2><?= $blog['title'] ?></h2>

                    <ul>
                        <li>By Admin</li>
                        <li><?= date("d/m/Y", strtotime($blog['created_at'])) ?></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog-details spad">
    <div class="container">
        <div class="row d-flex justify-content-center">

            <!-- IMAGE -->
            <div class="col-lg-12">
                <div class="blog__details__pic">
                    <img src="public/assets/images/<?= $blog['image'] ?>" alt="">
                </div>
            </div>

            <div class="col-lg-8">
                <div class="blog__details__content">

                    <!-- SHARE giữ nguyên -->
                    <div class="blog__details__share">
                        <span>share</span>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>

                    <!-- CONTENT -->
                    <div class="blog__details__text">
                        <p><?= nl2br($blog['content']) ?></p>
                    </div>

                    <!-- AUTHOR -->
                    <div class="blog__details__option">
                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="Client/View/Assets/img/blog/details/blog-author.jpg">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h5>Admin</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__tags">
                                    <a href="#">#TinTuc</a>
                                    <a href="#">#Shop</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- COMMENT FORM giữ nguyên -->
                    <div class="blog__details__comment">
                        <h4>Leave A Comment</h4>
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="text" placeholder="Name">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" placeholder="Phone">
                                </div>
                                <div class="col-lg-12 text-center">
                                    <textarea placeholder="Comment"></textarea>
                                    <button type="submit" class="site-btn">Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>