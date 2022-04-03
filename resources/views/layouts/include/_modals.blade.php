<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Please enter login</label>
                        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp"
                               v-model="login" required>
                        <div class="invalid-feedback" v-if="invalidLogin">
                            Please write a username.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Please enter password</label>
                        <input type="password" class="form-control" id="inputPassword" v-model="pass" required>
                        <div class="invalid-feedback" v-show="invalidPass">
                            Please write a password.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" @click.prevent="logIn">Login</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<div class="modal fade bd-example-modal-xl" id="postModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true" v-if="post">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post @{{post.id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="user">
                    <div class="avatar"><img :src="post.user.avatarfull" alt="Avatar"></div>
                    <div class="name">@{{post.user.personaname}}</div>
                </div>
                <div class="card mb-3">
                    <div class="post-img" v-bind:style="{ backgroundImage: 'url(' + post.img + ')' }"></div>
                    <div class="card-body">
                        <div class="likes" @click="addLike('post', post.id)">
                            <div class="heart-wrap" v-if="!likes">
                                <div class="heart">
                                    <svg class="bi bi-heart" width="1em" height="1em" viewBox="0 0 16 16"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 01.176-.17C12.72-3.042 23.333 4.867 8 15z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span>@{{post.likes}}</span>
                            </div>
                            <div class="heart-wrap" v-else>
                                <div class="heart">
                                    <svg class="bi bi-heart-fill" width="1em" height="1em" viewBox="0 0 16 16"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span>@{{likes}}</span>
                            </div>
                        </div>
                        <p class="card-text" v-for="comment in post.comments">
                            @{{comment.user.personaname + ' - '}}
                            <small class="text-muted">@{{comment.text}}</small>
                            <a role="button" @click="addLike('comment', comment.id)">
                                <svg class="bi bi-heart-fill" width="1em" height="1em" viewBox="0 0 16 16"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"
                                          clip-rule="evenodd"/>
                                </svg>
                                @{{ comment.likes }}
                            </a>
                        </p>
                        <form class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" id="addComment" v-model="commentText">
                            </div>
                            <button type="button" class="btn btn-primary" @click="addComment(post.id)">Add comment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add money</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter sum</label>
                        <input type="text" class="form-control" id="addBalance" v-model="addSum" required>
                        <div class="invalid-feedback" v-if="invalidSum">
                            Please write a sum.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" @click="refill">Add</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="amountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Amount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2 class="text-center">Likes: @{{amount}}</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="showBoosterpackInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Boosterpack info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover" v-if="boosterpackInfo">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Price</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="boosterpack in boosterpackInfo">
                            <td>@{{ boosterpack.name }}</td>
                            <td>@{{ boosterpack.price }}$</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
