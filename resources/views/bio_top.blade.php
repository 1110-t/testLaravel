@vite('resources/js/app.js')
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
    <form style="margin-left:30px;" action="{{ url('/admin/bio/detail_edit_delete')}}" method="POST">
        {{ csrf_field() }}
        <input name="id" type="hidden" value="{{ $detail->id }}">
        <input name="title" type="text" value="{{ $detail->title }}">
        <input name="date" type="date" value="{{ $detail->date }}">
        <input type="checkbox" name="date_display" {{ $detail->date_display == '1' ? 'checked' : '' }}>
        <button name="which" value="edit">編集</button>
        <button name="which" value="delete">削除</button>
    </form>
    <div style="margin-left:60px; display:flex;">
        @foreach($detail->biodetailimages as $detailimage)
            <div>
                <div style="width:150px;height:150px;border:1px solid black;box-size:border-box;">
                    <img style="width:100%;height:100%;object-fit:contain;" src="{{ asset("storage/bio/".$detailimage->path) }}">
                </div>
                <form action="{{ url('/admin/bio/detailimage_edit_delete')}}" method="POST">
                    {{ csrf_field() }}
                    <input name="id" type="hidden" value="{{ $detailimage->id }}">
                    <input type="hidden" name="path" value="{{$detailimage->path}}">
                    <button name="which" value="delete">削除</button>
                    <button name="which" value="up">←</button>
                    <button name="which" value="down">→</button>
                </form>
            </div>
        @endforeach
    </div>
    <form style="margin-left:60px;" action="{{ url('/admin/bio/detailimage_save')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="tempImgs"></div>
        <input type="hidden" name="biodetail_id" value={{ $detail->id }}>
        <input type="file" multiple name="path[]" class="imguploader" onChange="appendImage(this)"/>
        <button type="submit">登録</button>
    </form>
    @endforeach
    <form style="margin-left:30px;" action="{{ url('/admin/bio/detail_save')}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="bio_id" value={{ $bio->id }}>
        <input type="text" name="title">
        <input type="date" name="date">
        <input type="checkbox" name="date_display">
        <button type="submit">登録</button>
    </form>
@endforeach

<form action="{{ url('/admin/bio/save')}}" method="POST">
    {{ csrf_field() }}
    <input type="text" name="title">
    <button type="submit">登録</button>
</form>