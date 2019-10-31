<script>
    function deleteObj(id){
        /*if(confirm("Are You Sure ?")){
            document.getElementById('form'+id).submit();
        }
        else{
        }*/


        $.confirm({
            title: 'Confirm!',
            content: 'Simple confirm!',
            buttons: {
                confirm: function () {
                    document.getElementById('del'+id).submit();
                },
                cancel: function () {

                }
            }
        });
    }
</script>
