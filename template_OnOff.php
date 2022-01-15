<script type="text/x-template" id="template-OnOff">
<select name="slider2" id="OnOff" data-role="slider">
  <option value="off">OffLine</option>
  <option value="on" onclick>OnLine</option>  
</select>
</script>
    
<script>
    setTimeout(function(){
        if(navigator.onLine == true)
        {
         document.getElementById("OnOff").value = "on";
         document.getElementById("OnOff").change;
         
        }
    else
        {
            document.getElementById("OnOff").value = "off";
        }
    }, 200);
        
    </script>
    
<script>
 var admin =  Vue.component('app-OnOff', {
template: '#template-OnOff'
  });
</script>