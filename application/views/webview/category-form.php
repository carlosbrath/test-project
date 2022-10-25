<div class="container">
    <div class="section">
        <div class="row">
            <form class="col s12" id="category-form">
                <div class="row">
                    <input type="hidden" id="category_id" name="category_id">
                    <div class="input-field col s6">
                        <input placeholder="Title" id="category_title" name="category_title" type="text" class="validate">
                        <label for="category_title">Title</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select id="vehical_type" name="vehical_type">
                            <option value="" disabled selected>Choose Type</option>
                            <option value="Public">Public</option>
                            <option value="Private">Private</option>
                            <option value="Personal">Personal</option>
                        </select>
                        <label for="vehical_type">Materialize Select</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Horsepower" id="horsepower" name="horsepower" type="number" class="validate">
                        <label for="first_name">Horsepower</label>
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
    // ---- update code goes here----------------
    $(document).ready(function() {
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
                            category_id: key,
                        },
                        entity: 'category_table',
                    }
                },
                dataType: 'json',
                success: function(data) {
                    $('#room-form-title').text('Update Space')
                    $('#category_id').val(data.category_id);
                    $('#category_title').val(data.category_title);
                    var type = data.vehical_type;
                    $('#vehical_type').val(type);
                    $('#vehical_type').formSelect();
                    $('#horsepower').val(data.horsepower);

                }
            });
        }
    })
</script>