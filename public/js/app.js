const STATUS_SUCCESS = 'success';
const STATUS_ERROR = 'error';
var app = new Vue({
    el: '#app',
    data: {
        login: '',
        pass: '',
        post: false,
        invalidLogin: false,
        invalidPass: false,
        invalidSum: false,
        posts: [],
        addSum: 0,
        amount: 0,
        likes: 0,
        commentText: '',
        boosterpacks: [],
        boosterpackInfo: [],
    },
    computed: {
        test: function () {
            var data = [];
            return data;
        }
    },
    created() {
        var self = this
        axios
            .get('/post/all')
            .then(function (response) {
                console.log(response.data.posts);
                self.posts = response.data.posts;
            })

        axios
            .get('/boosterpack/all')
            .then(function (response) {
                self.boosterpacks = response.data.boosterpacks;
            })
    },
    methods: {
        logout: function () {
            console.log('logout');
        },
        logIn: function () {
            var self = this;
            if (self.login === '') {
                self.invalidLogin = true
            } else if (self.pass === '') {
                self.invalidLogin = false
                self.invalidPass = true
            } else {
                self.invalidLogin = false
                self.invalidPass = false

                form = new FormData();
                form.append("email", self.login);
                form.append("password", self.pass);

                axios.post('/auth/login', form)
                    .then(function (response) {
                        console.log(response);
                        if (response.data.user) {
                            location.reload();
                        }
                        setTimeout(function () {
                            $('#loginModal').modal('hide');
                        }, 500);
                    })
            }
        },
        addComment: function (id) {
            var self = this;
            if (self.commentText) {

                var comment = new FormData();
                comment.append('postId', id);
                comment.append('commentText', self.commentText);

                axios.post(
                    '/comment/add',
                    comment
                ).then(function (response) {

                });
            }

        },
        refill: function () {
            var self = this;
            if (self.addSum === 0) {
                self.invalidSum = true
            } else {
                self.invalidSum = false
                sum = new FormData();
                sum.append('sum', self.addSum);
                axios.post('/profile/add_money', sum)
                    .then(function (response) {
                        setTimeout(function () {
                            $('#addModal').modal('hide');
                        }, 500);
                    })
            }
        },
        openPost: function (id) {
            var self = this;
            axios
                .get('/post/' + id)
                .then(function (response) {
                    self.post = response.data.post;
                    if (self.post) {
                        setTimeout(function () {
                            $('#postModal').modal('show');
                        }, 500);
                    }
                })
        },
        addLike: function (type, id) {
            var self = this;
            const url = '/' + type + '/like/' + id;
            axios
                .get(url)
                .then(function (response) {
                    self.likes = response.data.likes;
                })

        },
        buyPack: function (id) {
            var self = this;
            var pack = new FormData();
            pack.append('id', id);
            axios.post('/boosterpack/buy', pack)
                .then(function (response) {
                    self.amount = response.data.amount
                    if (self.amount !== 0) {
                        setTimeout(function () {
                            $('#amountModal').modal('show');
                        }, 500);
                    }
                })
        },
        infoPack: function (id) {
            var self = this;
            axios.get('/boosterpack/info/' + id)
                .then(function (response) {
                    self.boosterpackInfo = response.data.items;
                    if (self.boosterpackInfo) {
                        setTimeout(function () {
                            $('#showBoosterpackInfo').modal('show');
                        }, 500);
                    }
                })
        }
    }
});

