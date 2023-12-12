<?php
$form = json_encode($this->form->form);
?>
<div>
    <input type="hidden" id="hide_me" value="{{ $form }}">

    <div id="fb-reader"></div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ URL::asset('assets/form-builder/form-render.min.js') }}"></script>
<script>
    setTimeout(() => {
        let content = document.getElementById("hide_me").value;
        console.log(content);
        $(function() {

            $('#fb-reader').formRender({

                formData: JSON.parse(content)

            });


        });
    }, 50);
</script>
