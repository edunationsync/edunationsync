
    
    function savevoucher(id)
    {
      alert(id);
      var amount=0;
      var charges=0;
      var ref=document.getElementById(id+"ref").innerHTML;;
      var lateness=document.getElementById(id+"lateness").innerHTML;
      var duty=document.getElementById(id+"duty").innerHTML;
      var sgl=document.getElementById(id+"sgl").innerHTML;
      var lesson_plan_note=document.getElementById(id+"lesson_plan_note").innerHTML;
      var absenteesm=document.getElementById(id+"absenteesm").innerHTML;
      var scheme=document.getElementById(id+"scheme").innerHTML;
      var savings=document.getElementById(id+"savings").innerHTML;
      var staff_welfare=document.getElementById(id+"staff_welfare").innerHTML;
      var pay_amount=document.getElementById(id+"pay_amount").innerHTML;
      var balance=document.getElementById(id+"balance").innerHTML;
      var staffid=document.getElementById(id+"staffid").innerHTML;
      var year=document.getElementById("year").value;
      var month=document.getElementById("month").value;
      var date=document.getElementById("date").value;

      id=trimvalue(id);
      ref=trimvalue(ref);
      lateness=trimvalue(lateness);
      duty=trimvalue(duty);
      sgl=trimvalue(sgl);
      lesson_plan_note=trimvalue(lesson_plan_note);
      absenteesm=trimvalue(absenteesm);
      scheme=trimvalue(scheme);
      savings=trimvalue(savings);
      staff_welfare=trimvalue(staff_welfare);
      pay_amount=trimvalue(pay_amount);
      balance=trimvalue(balance);
      staffid=trimvalue(staffid);
      year=trimvalue(year);
      month=trimvalue(month);
      date=trimvalue(date);
      
      if(sgl>0)
      {
        pay_amount=eval(sgl)+eval(pay_amount);
      }
      else
      {
        pay_amount=eval(pay_amount);
      }
      
      document.getElementById(id+"pay_amount").innerHTML=amount;

      charges=(lateness*<?php echo $punnishmentChargeDetails['lateness']; ?>)-(duty*<?php echo $punnishmentChargeDetails['duty']; ?>)-(absenteesm*<?php echo $punnishmentChargeDetails['absenteesm']; ?>)-(lesson_plan_note*<?php echo $punnishmentChargeDetails['lesson_plan_note']; ?>)-(scheme)-(savings)-(staff_welfare);

      balance=(pay_amount-charges);
      
      document.getElementById(id+"balance").innerHTML=balance;

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200)
        {        
          Toast(this.responseText);
          
        }
        else
        {
          Toast("Processing...");
        }
      };


      xmlhttp.open("GET", "savevoucher.php?id="+id+
        "&ref="+ref+
        "&lateness="+lateness+
        "&duty="+duty+
        "&sgl="+sgl+
        "&lesson_plan_note="+lesson_plan_note+
        "&absenteesm="+absenteesm+
        "&scheme="+scheme+
        "&savings="+savings+
        "&staff_welfare="+staff_welfare+
        "&pay_amount="+pay_amount+
        "&balance="+balance+
        "&staffid="+staffid+
        "&year="+year+
        "&month="+month+
        "&date="+date
        , true);
      xmlhttp.send(); 
    }