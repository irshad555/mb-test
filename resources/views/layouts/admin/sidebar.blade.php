<aside>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{url('categories')}}">Catagories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('products')}}">product</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li> -->
        <li class="nav-item">

            <form action="{{url('/logout')}}" method="post">
                @csrf

                <button type="submit">logout</button>
            </form>
        </li>
    </ul>
</aside>