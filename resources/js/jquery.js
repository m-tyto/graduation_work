
$(".folder_checkbox").on("click", function(){
    $('.folder_checkbox').prop('checked', false);  //  全部のチェックを外す
    $(this).prop('checked', true);  //  押したやつだけチェックつける
});

window.dropped = "";
window.dragged = "";

window.dragstart = function dragstart(event){
                        const dragged = event.target;
                    }

window.dragover = function dragover(event){
                    // prevent default to allow drop
                    event.preventDefault();
                  }

window.drop = function drop(event){
                // prevent default action (open as link for some elements)
                event.preventDefault();
                // move dragged elem to the selected drop target
                const dropped = event.target.firstElementChild;
                if(dropped.checked == true && dropped.name == "folder"){
                    document.getElementById('divide_btn').click();
                }
                else{
                    alert("対象フォルダにチェックを入れてください");
                }
              }



window.confirmDivide = function confirmDivide(){
                            const tweet = document.getElementsByName("tweet[]");
                            let count = 0;
                            for(let i = 0; i < tweet.length; i++){
                                if(tweet[i].checked === true){
                                    count++;
                                }
                            }
                            if(count === 0){
                                alert("ツイートを選択してください");
                                return false;
                            }
                            
                            select = confirm("ツイートを分類しますか？");
                            if(select === false){
                                return false;
                            }
                        }
   
