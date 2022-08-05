
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
            table.append('<tr><td>'+element.id+'</td><td>'+element.title+'</td><td><a class="btn btn-primary" onclick="getCity('+element.id+')">Update</a></td><td><a class="btn btn-warning" onclick="deletePost('+element.id+')">Delete</a></td></tr>');
       });
    },
    error: function(err){
        console.log(err);
    }
   })

}

function getCity(id)
{
    var cityid; var name;
    location.href="/updateCity";
    $.ajax({
    url: 'https://jsonplaceholder.typicode.com/posts/'+id,
    type: "GET",
    success: function(result){
      
        console.log(result);
        $('#updateid').val(result.id);
        $('#updatename').val(result.title);
       
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