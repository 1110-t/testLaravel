@foreach($bios as $bio)
<form action="{{ url('/admin/bio/edit_delete')}}" method="POST">
    {{ csrf_field() }}
    <input name="id" type="hidden" value={{ $bio->id }}>
    <input name="order" type="number" value={{ $bio->order }}>
    <input name="title" type="text" value={{ $bio->title }}>
    <button name="which" value="edit">編集</button>
    <button name="which" value="delete">削除</button>
</form>
@endforeach

<form action="{{ url('/admin/bio/save')}}" method="POST">
    {{ csrf_field() }}
    <input type="text" name="title">
    <input type="number" name="order">
    <button type="submit">登録</button>
</form>