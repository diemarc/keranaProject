<div id="page-wrapper">
    <h2>[{title}]</h2>
    <section id='add_form' class='table-responsive'>
        <form action="[{url_save}]" 
              id="formKerana" name="formKerana" method="POST" class="form-horizontal"
              accept-charset="utf-8">
                  <?php echo $kerana_token; ?>

            <header class="breadcrumb">
                <a href="[{url_add}]" 
                   class="btn btn-warning">Cancelar</a>
                <button type="submit" class="btn btn-default">Submit</button>
            </header>

            [{form}]

        </form>
    </section>
</div>