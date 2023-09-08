
                function ToggleCASheetDisplay()
                {
                  var x=document.getElementById("ca_sheet_form");
                  if(x.style.display==="none")
                  {
                    x.style.display="block";
                  }
                  else
                    x.style.display="none";
                }

                function HideResultTools()
                {
                  var x=document.getElementById("ca_sheet_form");
                  if(!(x.style.display==="none"))
                  {
                    x.style.display="none";
                  }
                  else{
                    x.style.display="none";
                  }

                  var y=document.getElementById("master_sheet_form");
                  if(!(y.style.display==="none"))
                  {
                    y.style.display="none";
                  }
                  else
                    y.style.display="none";

                }

                function ToggleMasterSheetDisplay()
                {
                  var x=document.getElementById("master_sheet_form");
                  if(x.style.display==="none")
                  {
                    x.style.display="block";
                  }
                  else
                    x.style.display="none";
                }

                function loadSubjects(staff,session,term,classs)
                {
                  var xmlhttp = new XMLHttpRequest();
                  xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200)
                    {
                      document.getElementById("subjectContainer").innerHTML = this.responseText;
                    }
                    else
                    {
                      document.getElementById("subjectContainer").innerHTML = "Loading...";
                    }
                  };
                  xmlhttp.open("GET", "staffsubjectload.php?staff="+staff+"&session="+session+"&term="+term+"&classs="+classs, true);
                  xmlhttp.send();
                }

                function loadSubjectsp(classs)
                {
                  var xmlhttp = new XMLHttpRequest();
                  xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200)
                    {
                      document.getElementById("subjectContainerp").innerHTML = this.responseText;
                    }
                    else
                    {
                      document.getElementById("subjectContainerp").innerHTML = "Loading...";
                    }
                  };
                  xmlhttp.open("GET", "../result/staffsubjectloadp.php?classs="+classs, true);
                  xmlhttp.send();
                }


                function loadSubjectItems(classs)
                {   
                  var xmlhttp = new XMLHttpRequest();
                  xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200)
                    {
                      document.getElementById("subjectSelect").innerHTML = this.responseText;
                    }
                    else
                    {
                      document.getElementById("subjectSelect").innerHTML = "Loading...";
                    }
                  };
                  xmlhttp.open("GET", "../result/loadsubjectitems.php?classs="+classs, true);
                  xmlhttp.send();
                }

                
      //New Script from CA Sheet

        function validateca(id)
        {
          var values=document.getElementById(id).innerHTML;

          if(values==''){
            values=0;
          }
          else if(values.substr(values.length-4)=="<br>")
          {
            values=values.substr(0,values.length-4);

            if(values=='')
            {
              values=0;
            }
          }


          values=eval(values);



          if(values>20)
          {
            document.getElementById(id).style.background="RED";
          }
          else
          {
            document.getElementById(id).style.background="white";
          } 
        }

        function validateexam(id)
        {

          var values=document.getElementById(id).innerHTML;

          if(values==''){
            values=0;
          }
          else if(values.substr(values.length-4)=="<br>")
          {
            values=values.substr(0,values.length-4);

            if(values=='')
            {
              values=0;
            }
          }


          values=eval(values);

          if(values>60)
          {
            document.getElementById(id).style.background="RED";
          }
          else
          {
            document.getElementById(id).style.background="white";
          } 
        }

        function computeresult(id,subj)
        {
          var ids=id;
          id=id+subj;
          var Grade='';
          var Remark='';
          var Average=0;
          var grade='';
          var remark='';
          
          var ca,total,cat;
          var ca1=document.getElementById(id+"ca1").innerHTML;
          var ca2=document.getElementById(id+"ca2").innerHTML;
          var exam=document.getElementById(id+"exam").innerHTML;
          var Total=0;
          if(exam==''){
            exam=0;
          }
          else if(exam.substr(exam.length-4)=="<br>")
          {
            exam=exam.substr(0,exam.length-4);

            if(exam=='')
            {
              exam=0;
            }
          }

          if(ca1==''){
            ca1=0;
          }
          else if(ca1.substr(ca1.length-4)=="<br>")
          {
            ca1=ca1.substr(0,ca1.length-4);

            if(ca1=='')
            {
              ca1=0;
            }
          }

          if(ca2==''){
            ca2=0;
          }
          else if(ca2.substr(ca2.length-4)=="<br>")
          {
            ca2=ca2.substr(0,ca2.length-4);
            if(ca2=='')
            {
              ca2=0;
            }
          }
          cat=eval(ca1)+eval(ca2);
          total=eval(cat)+eval(exam);

          document.getElementById(id+"subjectTotalScore").innerHTML = eval(total);
          document.getElementById(id+"caT").innerHTML = eval(cat);

          if(total=='')
            total=0;
          if(total<=29){
            grade="F";
            remark="Fail";
          }
          else if(total<=39){
            grade="E";
            remark="Fair";
          }
          else if(total<=49){
            grade="D";
            remark="Pass";
          }
          else if(total<=59){
            grade="C";
            remark="Credit";
          }
          else if(total<=69){
            grade="B";
            remark="Very Good";
          }
          else if(total>=70){
            grade="A";
            remark="Excellent";
          }

          //Read all the subjects and add the scores of each subject
          subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
          for (var s = subjects.length - 1; s >= 0; s--) {

            var tt=eval(document.getElementById(ids+subjects[s]+"subjectTotalScore").innerHTML);
            if(tt==null)
            {
              tt=0;
            }
            Total=Total+tt;
          }
          //alert('<?php echo "man" ?>');
          //alert(subjects.length);

          Average=Total/subjects.length;
          if(Total=='')
            Total=0;
          if(Total<=((29/100)*(subjects.length*100))){
            Grade="F";
            Remark="Fail";
          }
          else if(Total<=((39/100)*(subjects.length*100))){
            Grade="E";
            Remark="Fair";
          }
          else if(Total<=((49/100)*(subjects.length*100))){
            Grade="D";
            Remark="Pass";
          }
          else if(Total<=((59/100)*(subjects.length*100))){
            Grade="C";
            Remark="Credit";
          }
          else if(Total<=((69/100)*(subjects.length*100))){
            Grade="B";
            Remark="Very Good";
          }
          else if(Total>=((70/100)*(subjects.length*100))){
            Grade="A";
            Remark="Excellent";
          }

          document.getElementById(ids+"Total").innerHTML = Total;
          document.getElementById(ids+"Grade").innerHTML = Grade;
          document.getElementById(ids+"Remark").innerHTML =Remark;
          document.getElementById(ids+"Average").innerHTML = Average.toFixed(2);
        }

        function testSaveScore(session,term,classs)
        {
          var subjects=[];
          var count=0;
          subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
          students=JSON.parse('<?php echo json_encode($Students); ?>');
          for (var s = students.length - 1; s >= 0; s--) {
            count++;
            for (var i = subjects.length - 1; i >= 0; i--) {
              //document.getElementById(students[i]+"exam").contentEditable="false";
              //alert(subjects[i]);
              savescore(students[s],subjects[i],session,term,classs);

            }
          }
        }

        function savescore(id,subject,session,term,classs)
        {
          var catotal=document.getElementById(id+subject+"caT").innerHTML;
          var total=document.getElementById(id+subject+"subjectTotalScore").innerHTML;
          var ca1=document.getElementById(id+subject+"ca1").innerHTML;
          var ca2=document.getElementById(id+subject+"ca2").innerHTML;
          var exam=document.getElementById(id+subject+"exam").innerHTML;
          var remark='';
          var grade='';


          if(exam==''){
            exam=0;
          }
          else if(exam.substr(exam.length-4)=="<br>")
          {
            exam=exam.substr(0,exam.length-4);

            if(exam=='')
            {
              exam=0;
            }
          }

          if(ca1==''){
            ca1=0;
          }
          else if(ca1.substr(ca1.length-4)=="<br>")
          {
            ca1=ca1.substr(0,ca1.length-4);

            if(ca1=='')
            {
              ca1=0;
            }
          }

          if(ca2==''){
            ca2=0;
          }
          else if(ca2.substr(ca2.length-4)=="<br>")
          {
            ca2=ca2.substr(0,ca2.length-4);
            if(ca2=='')
            {
              ca2=0;
            }
          }


          if(exam=='')
            exam=0;
          if(ca1=='')
            ca1=0;
          if(ca2=='')
            ca2=0;
          if(catotal=='')
            catotal=0;
          if(total=='')
            total=0;


  

              
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {        
              document.getElementById("preloader").style.display="none";
              document.getElementById("msgContainer").innerHTML = this.responseText;
            }
            else
            {   

              document.getElementById("preloader").style.display="block";           
              document.getElementById("msgContainer").innerHTML = "Loading...";
            }
          };
          xmlhttp.open("GET", "savescorep.php?student="+id+
            "&subject="+subject+
            "&session="+session+
            "&term="+term+
            "&ca1="+ca1+
            "&ca2="+ca2+
            "&catotal="+catotal+
            "&exam="+exam+
            "&total="+total+
            "&remark="+remark+
            "&grade="+grade+
            "&class="+classs
            , true);
          xmlhttp.send();
        }

        function cleanresultanalysis()
        {


          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              document.getElementById("preloader").style.display="none";
              document.getElementById("msgContainer").innerHTML = this.responseText;
            }
            else
            {
              document.getElementById("preloader").style.display="block";
              document.getElementById("msgContainer").innerHTML = document.getElementById("loader").innerHTML;
            }
          };
          xmlhttp.open("GET", "clean_result_analysisp.php" , true);
          xmlhttp.send();
        }

        function CA1Only()
        {  
          var subjects=[];
          var students=[];

          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = students.length - 1; i >= 0; i--) {
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]+subjects[s]+"ca1").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"ca2").contentEditable="false";
              document.getElementById(students[i]+subjects[s]+"exam").contentEditable="false";
            }
          }
          //btnca1
          //btnca2
          //btnca1ca2
          //btnexam
          //btnallscores
          document.getElementById("entryMsg").innerHTML="Only CA1 Mode Activated";
          if(document.getElementById("entryMsg").innerHTML==="Only CA1 Mode Activated")
          {
            document.getElementById("btnca1").style.backgroundColor="lightblue";
            document.getElementById("btnca1").style.color="black";


            document.getElementById("btnca2").style.backgroundColor="blue";
            document.getElementById("btnca2").style.color="white";

            document.getElementById("btnca1ca2").style.backgroundColor="blue";
            document.getElementById("btnca1ca2").style.color="white";

            document.getElementById("btnexam").style.backgroundColor="blue";
            document.getElementById("btnexam").style.color="white";

            document.getElementById("btnallscores").style.backgroundColor="blue";
            document.getElementById("btnallscores").style.color="white";
          }
          
        }

        function CA2Only()
        {  

          var subjects=[];
          var students=[];

          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = students.length - 1; i >= 0; i--) {
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]+subjects[s]+"ca2").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"ca1").contentEditable="false";
              document.getElementById(students[i]+subjects[s]+"exam").contentEditable="false";
            }
          }
          document.getElementById("entryMsg").innerHTML="Only CA2 Mode Activated";
          if(document.getElementById("entryMsg").innerHTML==="Only CA2 Mode Activated")
          {
            document.getElementById("btnca2").style.backgroundColor="lightblue";
            document.getElementById("btnca2").style.color="black";


            document.getElementById("btnca1").style.backgroundColor="blue";
            document.getElementById("btnca1").style.color="white";

            document.getElementById("btnca1ca2").style.backgroundColor="blue";
            document.getElementById("btnca1ca2").style.color="white";

            document.getElementById("btnexam").style.backgroundColor="blue";
            document.getElementById("btnexam").style.color="white";

            document.getElementById("btnallscores").style.backgroundColor="blue";
            document.getElementById("btnallscores").style.color="white";
          }
          
        }

        

        function ExamOnly()
        {  

          var subjects=[];
          var students=[];

          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = students.length - 1; i >= 0; i--) {
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]+subjects[s]+"exam").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"ca2").contentEditable="false";
              document.getElementById(students[i]+subjects[s]+"ca1").contentEditable="false";
            }
          }
          document.getElementById("entryMsg").innerHTML="Only Exam Mode Activated";
          if(document.getElementById("entryMsg").innerHTML==="Only Exam Mode Activated")
          {
            document.getElementById("btnexam").style.backgroundColor="lightblue";
            document.getElementById("btnexam").style.color="black";


            document.getElementById("btnca1").style.backgroundColor="blue";
            document.getElementById("btnca1").style.color="white";

            document.getElementById("btnca1ca2").style.backgroundColor="blue";
            document.getElementById("btnca1ca2").style.color="white";

            document.getElementById("btnca2").style.backgroundColor="blue";
            document.getElementById("btnca2").style.color="white";

            document.getElementById("btnallscores").style.backgroundColor="blue";
            document.getElementById("btnallscores").style.color="white";
          }
          
        }

        function BothCA()
        {  
          var subjects=[];
          var students=[];

          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = students.length - 1; i >= 0; i--) {
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]+subjects[s]+"ca1").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca2").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"exam").contentEditable="false";
              
            }
          }
          document.getElementById("entryMsg").innerHTML="Both CA Mode Activated";
          if(document.getElementById("entryMsg").innerHTML==="Both CA Mode Activated")
          {
            document.getElementById("btnca1ca2").style.backgroundColor="lightblue";
            document.getElementById("btnca1ca2").style.color="black";


            document.getElementById("btnca1").style.backgroundColor="blue";
            document.getElementById("btnca1").style.color="white";

            document.getElementById("btnexam").style.backgroundColor="blue";
            document.getElementById("btnexam").style.color="white";

            document.getElementById("btnca2").style.backgroundColor="blue";
            document.getElementById("btnca2").style.color="white";

            document.getElementById("btnallscores").style.backgroundColor="blue";
            document.getElementById("btnallscores").style.color="white";
          }
          
        }
        
        function AllScores()
        {   
          var subjects=[];
          var students=[];

          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = students.length - 1; i >= 0; i--) {
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]+subjects[s]+"ca1").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca2").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"exam").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="lightblue";
            }
          }
          
          document.getElementById("entryMsg").innerHTML="All Score Mode Activated";
          if(document.getElementById("entryMsg").innerHTML==="All Score Mode Activated")
          {
            document.getElementById("btnallscores").style.backgroundColor="lightblue";
            document.getElementById("btnallscores").style.color="black";


            document.getElementById("btnca1").style.backgroundColor="blue";
            document.getElementById("btnca1").style.color="white";

            document.getElementById("btnexam").style.backgroundColor="blue";
            document.getElementById("btnexam").style.color="white";

            document.getElementById("btnca2").style.backgroundColor="blue";
            document.getElementById("btnca2").style.color="white";

            document.getElementById("btnca1ca2").style.backgroundColor="blue";
            document.getElementById("btnca1ca2").style.color="white";
          }
          
          
        }


        function  print(elem)
        {
          var mywindow=window.open('','PRINT','height=auto,width=auto');
          mywindow.document.write('<html><head>'+document.title+'</title></head>');
          mywindow.document.write('<body>'+document.getElementById(elem).innerHTML+'</body></html>');

          mywindow.print();
          mywindow.close();

          return true;
        }

        function exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            
            // Specify file name
            filename = filename?filename+'.xls':document.title+'.xls';
            
            // Create download link element
            downloadLink = document.createElement("a");
            
            document.body.appendChild(downloadLink);
            
            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            
                // Setting the file name
                downloadLink.download = filename;
                
                //triggering the function
                downloadLink.click();
            }
        }

        function toggleMenu(btn,menu)
        {

          if(document.getElementById(menu).style.display=='none')
          {
            document.getElementById(menu).style.display='block';
            document.getElementById(btn).innerHTML='Hide Menu';   
          }
          else
          {          
            document.getElementById(menu).style.display='none';
            document.getElementById(btn).innerHTML='Show Menu';
          }
        }
      //Old Script from CA Sheet