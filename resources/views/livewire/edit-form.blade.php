<?php
$form = json_encode($this->form->form);
?>
<div>
    <input type="hidden" id="hide_me" value="{{ $form }}">
    <form id="form">
        <div id="fb-reader"></div>
        <input type="submit" value="Save" class="btn btn-success" />
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ URL::asset('assets/form-builder/form-render.min.js') }}"></script>
<script>
    setTimeout(() => {
        let content = document.getElementById("hide_me").value;
        console.log(content);
        $(function() {

            let rendered_form = $('#fb-reader').formRender({

                formData: JSON.parse(content)

            });
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log(JSON.stringify(rendered_form.userData));
                @this.dispatch('update', {
                    message: JSON.stringify(rendered_form.userData)
                });

            })

        });
    }, 50);
</script>
