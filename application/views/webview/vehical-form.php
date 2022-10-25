<div class="container">
    <div class="section">
        <div class="row">
            <form class="col s12" id="vehical-form">
                <div class="row">
                    <input type="hidden" id="id" name="id">
                    <div class="input-field col s6">
                        <input placeholder="Model" id="model" name="model" type="text" class="validate">
                        <label for="model">Model</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select id="color">
                            <option value="" disabled selected>Choose Color</option>
                            <option value="Red">red</option>
                            <option value="Black">Black</option>
                            <option value="Blue">Blue</option>
                            <option value="Green">Green</option>
                            <option value="Silver">Silver</option>
                        </select>
                        <label>Materialize Select</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select id="category">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Materialize Select</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Registration No" id="registration_no" name="registration_no" type="text" class="validate">
                        <label for="registration_no">Registration No</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Date" id="make" name="make" type="date" class="validate">
                        <label for="make">Make</label>
                    </div>
                </div>
                <div class="input-field s4">
                    <input type="submit" value="Save & Exit" class="btn">
                </div>
            </form>
        </div>
        <br><br>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "" + base_link + "ApiController/crud_operations",
            data: {
                crud: {
                    ops: 'read-data',
                    fields: '*',
                    entity: 'category_table',
                }
            },
            dataType: 'json',
            success: function(data) {
                var s = '<option value="" disabled selected>Category</option>';
                for (var i = 0; i < data.length; i++) {
                    s += '<option value="' + data[i].category_id + '">' + data[i].category_title + '</option>';
                }
                $("#category").html(s);
                $('#category').formSelect();
            }
        });

        // ---------Update Vehical-----------------
        var key = '<?php echo $id; ?>'
        if (!isEmpty(key)) {
            $.ajax({
                type: "POST",
                url: "" + base_link + "ApiController/crud_operations",
                data: {
                    crud: {
                        ops: 'read-row',
                        fields: '*',
                        condition: {
                            id: key,
                        },
                        entity: 'vehical_table',
                    }
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    $('#id').val(data.id);
                    $('#model').val(data.model);
                    var category = data.category_id;
                    $('#category_id').val(category);
                    $('#category_id').formSelect();
                    $('#color').val(data.color);
                    $('#registration_no').val(data.registration_no);
                    $('#make').val(data.make);
                }
            });
        } 
    })
</script>