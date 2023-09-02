// イベントを付与して、ファイルが書き換わったら表示するように設定
window.appendImage = function(e){
    // 画像を表示する領域を確保
    let imgs = e.closest("form").querySelector(".tempImgs");
    // 画像を取得
    let files = e.files;
    // 先に入っている画像を消去する
    imgs.innerHTML = "";
    // 画像ファイルをそれぞれ参照する
    for (let index = 0; index < files.length; index++) {
        let file = files[index];
        // blob形式で画像を取得する
        let blobUrl = window.URL.createObjectURL(file);
        // 画像を表示する
        let img = document.createElement("img");
        img.style.maxWidth = "300px";
        img.style.maxHeight = "300px";
        img.src = blobUrl;
        imgs.appendChild(img);
    }
};