<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">饿了吧后台管理系统</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        {{--以下是分类导航--}}
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('shops.index')}}">商家信息管理<span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="{{route('shopscategory.index')}}">店铺分类管理<span class="sr-only">(current)</span></a></li>
                {{--<li><a href="{{ route('addStudent') }}">添加学生</a></li>--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜单栏<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admin.index')}}">管理员管理</a></li>
                        <li><a href="{{route('users.index')}}">商家用户管理</a></li>
                        <li><a href="{{route('roles.index')}}">角色管理</a></li>
                        <li><a href="{{route('permissions.index')}}">权限管理</a></li>
                        <li><a href="{{route('members')}}">会员管理</a></li>
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">One more separated link</a></li>--}}
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" action="">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="keyword">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                {{--游客登录--}}
                @guest
                <li><a href="#" data-toggle="modal" data-target="#myModal">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        {{--<li><a href="{{route('users.index')}}">用户中心</a></li>--}}
                        <li><a href="{{route('admin.edit',[auth()->user()->id])}}">个人中心</a></li>
                        <li><a href="{{route('admin.pass',['admin'=>auth()->user()])}}">修改个人密码</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form method="get" action="{{route('logout')}}">
                                {{csrf_field()}}
                                {{--{{method_field('DELETE')}}--}}
                                <button class="btn btn-link btn-info">注销</button>
                            </form></li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">登录</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('login')}}" method="post">
                            <div class="form-group">
                                <label>用户名</label>
                                <input type="text" class="form-control" name="name"  placeholder="用户名">
                            </div>
                            <div class="form-group">
                                <label>密码</label>
                                <input type="password" class="form-control" name="password" placeholder="密码">
                            </div>

                            <div class="form-group">
                                <label>验证码</label>
                                <input id="captcha1" class="form-control" name="captcha" >
                                <img id="captcha_login" class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="rememberMe">下次自动登录
                                </label>
                            </div>
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-default btn-block">登录</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</nav>

