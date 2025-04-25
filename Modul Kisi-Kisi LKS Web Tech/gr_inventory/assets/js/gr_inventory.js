$("#gr_inventory_table").bfDataTable({
  url: site_url + "admin/inventory/gr_inventory/get_data",
  targetUrl: site_url + "admin/inventory/gr_inventory/edit",
  filterCols: [0, 2],
  sortCols: { id: "desc" },
  lengthMenu: [10, 100, 1000],
  columns: [
    { data: "nama_gudang" },
    { data: "tanggal" },
    { data: "deskripsi" },
  ],
});

$("#tanggal").dateDropper({
  modal: true,
  large: true,
});

$(document).ready(function() {
    // Handle row click untuk checkbox
    $('.clickable-row').click(function(event) {
        if (!$(event.target).is('.form-check-input') && !$(event.target).is('.delete-row') && !$(event.target).is('.fa-trash')) {
            var checkbox = $(this).find('.form-check-input');
            checkbox.prop('checked', !checkbox.prop('checked'));
        }
    });

    // Handle button tambahkan click
    $('#btn_tambahkan').click(function(e) {
        e.preventDefault();
        
        // Get selected rows
        var selectedRows = $('.form-check-input:checked').closest('tr');
        
        // if (selectedRows.length === 0) {
        //     alert('Silahkan pilih minimal satu item');
        //     return;
        // }

        // Clear "no items" message if exists
        if ($('#selected_body tr td[colspan="10"]').length > 0) {
            $('#selected_body').empty();
        }

        // Move selected rows to top table
        selectedRows.each(function() {
            var originalRow = $(this);
            var newRow = $('<tr>');
            
            // Copy data cells (skip checkbox and delete button cells)
            originalRow.find('td:not(:first-child):not(:last-child)').each(function() {
                newRow.append($(this).clone());
            });

            // Add return button with down arrow
            newRow.append(`
                <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm return-item">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                </td>
            `);

            // Store original data for return
            newRow.data('original-html', originalRow.html());
            newRow.data('id', originalRow.data('id'));
            newRow.data('jumlah', originalRow.data('jumlah'));
            newRow.data('deskripsi', originalRow.data('deskripsi'))
            newRow.data('gudang', originalRow.data('gudang'))

            $('#selected_body').append(newRow);
            originalRow.remove();
        });

        // Check if source table is empty
        if ($('#detail_body tr').length === 0) {
            $('#detail_body').append(`
                <tr>
                    <td colspan="11" class="text-center">Tidak ada data detail</td>
                </tr>
            `);
        }

        // Uncheck all checkboxes
        $('.form-check-input').prop('checked', false);
    });

    // Handle return button click (using event delegation)
    $(document).on('click', '.return-item', function(e) {
        e.preventDefault();
        var topRow = $(this).closest('tr');
        var originalHtml = topRow.data('original-html');
        
        // Create new row for bottom table
        var newBottomRow = $('<tr class="clickable-row" style="cursor: pointer;">').html(originalHtml);
        newBottomRow.data('id', topRow.data('id'));
        newBottomRow.data('jumlah', topRow.data('jumlah'))
        newBottomRow.data('deskripsi', topRow.data('deskripsi'))
        newBottomRow.data('gudang', topRow.data('gudang'))
        
        // Remove "no items" message if exists
        if ($('#detail_body tr td[colspan="11"]').length > 0) {
            $('#detail_body').empty();
        }
        
        // Add to bottom table
        $('#detail_body').append(newBottomRow);
        
        // Remove from top table
        topRow.remove();
        
        // Check if top table is empty
        if ($('#selected_body tr').length === 0) {
            $('#selected_body').append(`
                <tr>
                    <td colspan="10" class="text-center">Belum ada item yang dipilih</td>
                </tr>
            `);
        }
    });

    // Form submit handler
    $('form').on('submit', function(e) {
        $('input[name="selected_ids"]').remove();

        var selectedIds = [];
        $('#selected_body tr').each(function() {
            var id = $(this).data('id');
            var id_jumlah = $(this).data('jumlah')
            var deskripsi = $(this).data('deskripsi')
            var gudang_id = $(this).data('gudang')
            if (id){
                selectedIds.push({
                    id,
                    id_jumlah,
                    deskripsi,
                    gudang_id
                })
            } 
        });

        if (selectedIds.length === 0) {
            e.preventDefault();
            alert('Silahkan pilih minimal satu item');
            return false;
        }

        $('<input>').attr({
            type: 'hidden',
            name: 'selected_ids',
            value: JSON.stringify(selectedIds)
        }).appendTo($(this));

        return true;
    });
});