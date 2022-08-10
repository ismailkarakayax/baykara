
$(document).ready(function(){
    getlist();
});

function getlist()
{
    var id;
    var title;
    var body;
    const liste=document.querySelector("#tblist");

   $.ajax({
    url: 'https://127.0.0.1:8000/v1/api/city',
    type: "GET",
    success: function(result){
        console.log(result);
        var table=$('#tblist');
        table.empty();

        result.forEach(element => {
            table.append('<tr><td>'+element.id+'</td><td>'+element.name+'</td><td><a class="btn btn-primary" onclick="popupOpen('+element.id+')">Update</a></td><td><a class="btn btn-warning" onclick="deletePost('+element.id+')">Delete</a></td></tr>');
       });
    },
    error: function(err){
        console.log(err);
    }
   })

}


function deletePost(id)
{
    
    $.ajax({
        
        url: 'https://127.0.0.1:8000/v1/api/city/'+id,
        type: "DELETE",
        success: function(result){
            console.log(result.id);
            alert("post silindi");
            getlist();
            
    
        },
        error: function(err){
            console.log(err);
        }
       })


}


function CreatePost()
{
  if(document.getElementById("inputname").value=="")
  {
    alert("name alanını boş bırakmayınız")
  }
  else
  {
    var name=document.getElementById("inputname").value

    $.ajax({
        url: 'https://127.0.0.1:8000/v1/api/cityAdd',
        method: 'POST',
        data:{
            name:name
        },
        success: function(data){
            console.log(data);
            alert("post kayıt edildi");

        },
        error: function(err){
            console.log(err);
        }
       })
  }
    
}


// document.getElementById("updatebtn").addEventListener("click",function(){
//     document.querySelector(".popup").style.display="flex";
// })

function popupOpen(id)
{
   

    $.ajax({
        url: 'https://127.0.0.1:8000/v1/api/city',
        type: "GET",
        dataType:'json',
        success: function(result){
            console.log(result)
            document.querySelector(".popup").style.display="flex";
            // localStorage.setItem("dataupdateid",result.id);
            // localStorage.setItem("dataupdate",result.name);
            result.forEach(element => {
                if(element.id==id)
                {
                    document.getElementById("updateId").value=element.id;
                    document.getElementById("updatename").value=element.name;
                }
           });
            
        },
        error: function(err){
            console.log(err);
        }
       })
}

function popupClose()
{
    document.querySelector(".popup").style.display="none";
}

function UpdatePost()
{
    var id=document.getElementById("updateId").value
    var name=document.getElementById("updateTitle").value

    $.ajax({
        url: 'https://127.0.0.1:8000/v1/api/city/'+id,
        method: 'PUT',
        data:{
           name:name
        },
        success: function(result){
            console.log(result);
            alert("post güncellendi")
            
            

        },
        error: function(err){
            console.log(err);
        }
    })   
}
