<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-pilih-dosen">

    <div class="text-center mt-4 mb-5">
        <h1 class="display-6">Polling Dosen dan Mahasiswa Terpopuler!</h1>
    </div>

    <!-- <div class="jumbotron mt-0 mb-0 text-center bg-transparent">
        <h1 class="display-6">Polling Dosen dan Mahasiswa Terpopuler!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div> -->

    <div class="body-content my-5">

        <div class="row ">
            <div class="col-6 text-center justify-content-center">
                <div class="card border border-dark">
                    <h5 class="font-weight-bold mt-3">Dosen Terpopuler</h5>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Dosen</th>
                                    <th scope="col">Polling</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Dosen1</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Dosen2</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Dosen3</td>
                                    <td>9</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="site/pilih-dosen.php" class="btn btn-primary btn-block">Pilih Dosen</a>
                    </div>
                </div>
            </div>

            <div class="col-6 text-center justify-content-center">
                <div class="card border border-dark">
                    <h5 class="font-weight-bold mt-3">Mahasiswa Terpopuler</h5>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Mahasiswa</th>
                                    <th scope="col">Polling</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>Mahasiswa1</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td>Mahasiswa2</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <th>3</th>
                                    <td>Mahasiswa3</td>
                                    <td>9</td>
                                </tr>
                            </tbody>
                        </table>
                        <a class="btn btn-primary btn-block">Pilih Mahasiswa</a>
                    </div>
                </div>
            </div>


            <!-- <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div> -->

        </div>

    </div>
</div>