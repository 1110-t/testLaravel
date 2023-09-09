class Start{
    show(){
        // 最初にメニューやタイトルをフェードインする
        let st = document.querySelectorAll(".start");
        // すべての要素にアクセス
        for(let i = 0; i < st.length; i++){
            // 要素にアクセス
            st[i].classList.remove("--fade");
            st[i].classList.add("--trans");
        };
    };
};

window.start = new Start();

// load
window.addEventListener('load', function(e){
    // 3秒後に実行
    setTimeout(function(){
        start.show();
    },3000);
});