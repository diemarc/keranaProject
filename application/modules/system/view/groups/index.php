<div id="page-wrapper">
    <h4 class='text-primary'> 
        <i class="fa fa-users fa-2x"></i>
        <span class='text-muted'>system</span>UserGroups
    </h4>
    <header class="breadcrumb">
        <a href="http://local.keranaproject/system/group/add" 
           class="btn btn-default btn-sm">
            <i class='fa fa-plus'></i>
        </a>
    </header>
    <section id='results' class='table-responsive'>
        <table class="table table-bordered table-condensed table-hover">
            <thead class='bg-warning'>
                <tr>
                    <th class="bg-primary">Options</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rsGroups AS $group): ?>
                    <tr> 
                        <td> 
                            <a href='/system/group/edit/<?php echo $group->id_group; ?>' 
                               class='btn btn-default btn-xs' title='Edit'>
                                <i class='fa fa-edit'></i>
                            </a> 
                            <a href='/system/group/delete/<?php echo $group->id_group; ?>' 
                               class='btn btn-danger btn-xs' title='Delete'>
                                <i class='fa fa-trash'></i></a> 
                        </td> 
                    </tr> 
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>