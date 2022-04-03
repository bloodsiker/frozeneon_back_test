@extends('layouts.app')

@section('content')
    <div class="main">
        @auth
            <div class="posts">
                <h1 class="text-center">Posts</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-4" v-for="post in posts" v-if="posts">
                            <div class="card">
                                <img :src="post.img" class="card-img-top"
                                     alt="Photo">
                                <div class="card-body">
                                    <h5 class="card-title">Post - @{{post.id}}</h5>
                                    <p class="card-text">@{{post.text}}</p>
                                    <button type="button" class="btn btn-outline-success my-2 my-sm-0"
                                            @click="openPost(post.id)">Open post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="boosterpacks">
                    <h1 class="text-center">Boosterpack's</h1>
                    <div class="container">
                        <div class="row">
                            <div class="col-4" v-for="boosterpack in boosterpacks" v-if="boosterpacks">
                                <div class="card">
                                    <img :src="'/images/box.png'" class="card-img-top" alt="Photo">
                                    <div class="card-body">
                                        <div class="btn-group" role="group" aria-label="...">
                                            <button type="button" class="btn btn-outline-success my-2 my-sm-0"
                                                    @click="buyPack(boosterpack.id)">Buy boosterpack @{{boosterpack.price}}$
                                            </button>
                                            <button type="button" class="btn btn-outline-info my-2 my-sm-0"
                                                    @click="infoPack(boosterpack.id)">Info boosterpack
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                If You need some help about core - read README.MD in system folder
                <br>
                What we have done All posts: <a href="/post/all">/post/all</a> One post: <a
                    href="/post/1">/post/1</a>
                <br>
                Just go coding Login: <a href="/login">/login</a> Make boosterpack feature <a
                    href="/boosterpack/buy">/boosterpack/buy</a> Add money feature <a
                    href="/profile/add_money">/profile/add_money</a>
            </div>
        @else
            <h1 class="text-center">You need to login</h1>
        @endauth
    </div>
@endsection
