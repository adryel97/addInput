<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
        <style>
            @media screen and (max-width: 767px){
                .lista__fone{
                     background: #eee;
                     border-radius: 4px;
                     box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                }
            }
        </style>
    </head>
    <body>
    <div class="col-lg-6">
        <div class="rows" data-rows="1">
            <div class="row form-row lista__fone mb-3 mt-3 p-2" data-row="1" id="row">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                    <label>Fone</label>
                    <input name="child[1][name]" class="form-control" id="child-1-name" type="text" data-duplicate>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 form-group">
                    <label>Descricao</label>
                    <input name="child[1][height]" id="child-1-height" class="form-control" type="text" data-duplicate>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4 col-xl-4 p-0 pr-2">
            <button class="add-child btn btn-primary w-100" data-addrow="#row"> 
            <span class="fa-layers fa-fw" style="background:transparent">
                <i class="fas fa-mobile-alt fa-lg " style="font-size:1.2em;"></i>
                <span class="fa-layers-counter fas fa-plus fa-2x" style="background:#fff; color: #007bff;" data-fa-transform="shrink-1"></span>
            </span>
            Adicionar
            </button>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                    $('body').on('click', '[data-addrow]', function(e) {
                        e.preventDefault();
                        addRow($($(this).attr('data-addrow')));
                    });
                $('body').on('click', '[data-removerow]', function(e) {
                    e.preventDefault();
                    removeRow($(this).parents('[data-row]'));
                });
                });

                function setupRows(rows) {
                var row = rows.find('[data-row]'),
                    current = 0;
                
                row.each(function() {
                    current++;
                    $(this).attr('data-row', current);
                    updateDuplicates($(this), current);
                });
                
                rows.attr('data-rows', current);
                }

                function addRow(row) {
                var rows = row.parents('[data-rows]'),
                    new_row = row.clone(),
                    remove_btn = $('<div class="col-md-12 col-lg-4 col-xl-4 form-group align-items-end d-flex flex-row">' + 
                    '<button class="add-child btn btn-danger w-100" data-removerow>' +
                    ' <span class="fa-layers fa-fw" style="background:transparent">'+
                        '<i class="fas fa-mobile-alt fa-lg " style="font-size:1.2em;"></i>' +
                        '<span class="fa-layers-counter fas fa-minus fa-2x" style="background:#fff; color: #dc3545;" data-fa-transform="shrink-1"></span>' + 
                    '</span> Remover ' +
                    '</button></div>');

                new_row
                    .removeAttr('id')
                    .append(remove_btn);

                rows.append(new_row);
                
                setupRows(rows);
                }

                function removeRow(row) {
                var rows = row.parents('[data-rows]');
                
                row.remove();
                
                setupRows(rows);
                }

                function updateDuplicates(row, current) {
                var duplicates = row.find('[data-duplicate]');
                
                duplicates.each(function() {
                    var name = $(this).attr('name');
                    var id = $(this).attr('id');
                    name = name.replace( /\[\d+\]/g, '[' + current + ']');
                    id = id.replace( /\-\d+\-/g, '-' + current + '-');
                    $(this)
                    .attr('name', name)
                    .attr('id', id);
                });
                }
        </script>
    </body>
</html>