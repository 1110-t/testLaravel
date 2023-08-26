@foreach($bios as $bio)
<form action="{{ url('/admin/bio/edit_delete')}}" method="POST">
    {{ csrf_field() }}
    <input name="id" type="hidden" value={{ $bio->id }}>
    <input name="order" type="number" value={{ $bio->order }}>
    <input name="title" type="text" value="{{ $bio->title }}">
    <button name="which" value="edit">編集</button>
    <button name="which" value="delete">削除</button>
    <button name="which" value="up">↟</button>
    <button name="which" value="down">↓</button>
</form>
    @foreach($bio->biodetails as $detail)
    <form style="margin-left:30px;" action="{{ url('/admin/bio/edit_delete')}}" method="POST">
        <input name="title" type="text" value="{{ $detail->title }}">
        <button name="which" value="edit">編集</button>
        <button name="which" value="delete">削除</button>
        <button name="which" value="up">↟</button>
        <button name="which" value="down">↓</button>
    </form>
    @endforeach
@endforeach

<form action="{{ url('/admin/bio/save')}}" method="POST">
    {{ csrf_field() }}
    <input type="text" name="title">
    <button type="submit">登録</button>
</form>