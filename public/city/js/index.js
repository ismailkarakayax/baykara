
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
    url: 'https://jsonplaceholder.typicode.com/posts',
    type: "GET",
    success: function(result){
        console.log(result);
        var table=$('#tblist');
        table.empty();

        result.forEach(element => {
            table.append('<tr><td>'+element.id+'</td><td>'+element.title+'</td><td><a class="btn btn-primary" onclick="">Update</a></td><td><a class="btn btn-warning" onclick="deletePost('+element.id+')">Delete</a></td></tr>');
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
        
        url: 'https://jsonplaceholder.typicode.com/posts/'+id,
        type: "DELETE",
        success: function(result){
            console.log(result.id);
            alert("post silindi");
            
    
        },
        error: function(err){
            console.log(err);
        }
       })


}


function CreatePost()
{
  if(ocument.getElementById("inputname").value=="")
  {
    alert("name alanını boş bırakmayınız")
  }
  else
  {
    var name=document.getElementById("inputname").value

    $.ajax({
        url: 'http://localhost:3000/posts',
        method: 'POST',
        dataType:'json',
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
