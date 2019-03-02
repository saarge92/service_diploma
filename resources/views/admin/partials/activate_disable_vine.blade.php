@if($vine->is_active == true)
    <div class="mx-auto mt-2">
        <form action="{{route('deactivateVine',['id'=>$vine->id])}}" method="POST">
            {{csrf_field()}}
            <button type="submit" class="btn btn-outline-danger deactivate-btn">Деактивировать</button>
        </form>
    </div>
    @else
    <div class="mx-auto mt-2">
        <form class="" action="{{route('activateVine',['id'=>$vine->id])}}" method="post">
            {{csrf_field()}}
            <button type="submit" class="btn btn-outline-primary deactivate-btn">Активировать</button>
        </form>
    </div>
    @endif
    <div class="mx-auto mt-1">
        <form action="{{route('deleteVine',['id'=>$vine->id])}}" method="POST">
            {{csrf_field()}}
            <button type="submit" class="btn btn-outline-dark delete">
                <i class="fas fa-times"></i>Удалить
            </button>
        </form>
    </div>
