var xhr = new XMLHttpRequest();

xhr.onload = function() {  
 

    responseObject = JSON.parse(xhr.responseText);
	                                               
    
    var newContent = '';
    

    newContent += '<tr>';
    newContent += '<th>모집부문</th>';
    newContent += '<th>전공</th>';
    newContent += '</tr>';
    
    for (var i = 0; i < responseObject.years.length; i++) { 
      newContent += '<tr>';
      newContent += '<td>' + responseObject.years[i].part + '</td>';
      newContent += '<td>' + responseObject.years[i].major + '</td>';
      newContent += '</tr>';   
    }
   
 
    document.getElementById('uni_json').innerHTML = newContent;
   

  //}
};

xhr.open('GET', 'data/data.json', true);        // 요청을 준비한다.
xhr.send(null);                                 // 요청을 전송한다
