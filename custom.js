function upload_file(e) {
    e.preventDefault();
    ajax_file_upload(e.dataTransfer.files,'box1');
	
}
  
function file_explorer() {
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function() {
        files = document.getElementById('selectfile').files;
        ajax_file_upload(files,'box1');
    };
}

function upload_file2(e) {
    e.preventDefault();
    ajax_file_upload(e.dataTransfer.files,'box2');
}
  
function file_explorer2() {
    document.getElementById('selectfile2').click();
    document.getElementById('selectfile2').onchange = function() {
        files = document.getElementById('selectfile2').files;
        ajax_file_upload(files,'box2');
    };
}
  
function ajax_file_upload(files_obj,box_obj) {
    if(files_obj != undefined) {
        var form_data = new FormData();
        for(i=0; i<files_obj.length; i++) {
            form_data.append('file[]', files_obj[i]);
        }
		
		var recID = document.getElementById('survey_id').value;
		
		form_data.append('survey_id', recID);
		form_data.append('box', box_obj);
        
		var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "ajax.php", true);
        xhttp.onload = function(event) {
            if (xhttp.status == 200) {
				var myArr = JSON.parse(this.responseText);
				// console.log(myArr);
				document.getElementById("survey_id").value = myArr.last_id;
				if(box_obj == 'box1'){
					document.getElementById("drop_file_zone").classList.add("imgFilled"); 
					document.getElementById("img_str_up").innerHTML = myArr.img_name_str; 
				}
				if(box_obj == 'box2'){
					document.getElementById("drop_file_zone2").classList.add("imgFilled"); 
					document.getElementById("img_str").innerHTML = myArr.img_name_str; 
				}

            } else {
                alert("Error " + xhttp.status + " occurred when trying to upload your file.");
            }
        }
 
        xhttp.send(form_data);
    }
}