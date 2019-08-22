<?php

get_header(); ?>

        <div class="main" style='background-image: url(" <?php echo get_stylesheet_directory_uri() . '/images/main.png';?> ")'>
            <form class="form" action="" method="post" enctype = 'multipart/form-data' ">
            <fieldset>
                <label for="fio">ФИО </label><br>
                <input id="fio" type="text" name="fio" value="" >
                <span class="error"> </span>
                <br>
                <label for="email">E-mail </label><br>
                <input id="email" type="text" name="email" value="" >
                <span class="error"> </span>
                <br>
                <div id="phone_container">
                    <div class="form-group">
                        <div class="form-control">
                            <label for="phone0" >Телефон </label><br>
                            <input id="phone0" name="phone[]" class="phones" type="text" data-validate="0" value="">
                            <span class="error"> </span>
                        </div>
                        <div class="form-control">
                            <input id="plus" type="button" name="plus" value="+"><br>
                        </div>
                    </div>
                </div>

                <label for="age">Возраст </label><br>
                <input id="age" type="text" name="age" value="">
                <span class="error"> </span>
                <br>
                <div id="foto_container">
                    <span>Фотография </span><br>
                    <label for="photo">
                        <div id="label-photo-box">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/images/upload.png';?>" alt="Upload foto">
                        </div>

                    </label>
                    <input id="photo" type="file" name="photo" />
                    <span class="error"> </span>
                </div>
                <span class="error"> </span>
                <div id="resume_box">
                    <label for="resume">Резюме </label><br>
                    <textarea id="resume" name="resume" ></textarea>
                    <span class="error"> </span>
                    <br><br>
                </div>
                <input id="submit" type="submit" name="uploadBtn" value="Отправить" />
            </fieldset>
            </form>
        </div>

<?php get_footer(); ?>