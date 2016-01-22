<div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="about_title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <!-- ======================================================= -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="ol-md-8 col-lg-offset-2">
                    <h3 class="modal-title" id="about_title">Информация о приложении</h3>
                </div>
            </div>
                <!-- ======================================================= -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <p>
                                Это приложение позволит быстро и легко создать 3D-эфекты для Вашего сайта
                            </p>
                            <hr/>
                            <br/>
                <!-- ======================================================= -->
                            <h4>Основные идеи</h4>
                            <div class="row">
                                <div class="col-md-3 alert alert-info">
                                    Максимально упростить создание 3D-графики для WEB.
                                </div>
                                <div class="col-md-3 col-md-offset-1 alert alert-info">
                                    Избавить разработчика, верстальщика или кого-либо другого от написания кода.
                                </div>
                                <div class="col-md-3 col-md-offset-1 alert alert-info">
                                    Получить файл со скриптом созданной 3D-сцены и "прикрутить" его в любом месте своего сайта.
                                </div>
                            </div>
                            
                            <hr/>
                            <br/>
                <!-- ======================================================= -->
                            <h4>Как использовать</h4>
                            <ol>
                                <li>
                                    Создайте свою 3D-сцену при помощи графического интерфейса приложения
                                </li>
                                <br/>
                                <li>
                                    Нижмите на кнопку "Получить файл скрипта" (нижняя кнопка в правой панели)
                                </li>
                                <br/>
                                <li>
                                    В появившемся окне введите имя под которым будет закачан файл со скриптом 3D-сцены на Ваш компьютер<br/>
                                    Это имя также будет использоваться как идентификатор блока (напримет <code>&lt;div&gt</code>), в который нужно будет поместить созданную 3D-сцену
                                </li>
                                <br/>
                                <li>
                                    Подключите в Ваш html-файл две javascript-библиотеки:
                                    <ul style="padding-left: 15px">
                                        <li>
                                            практически всем известная <a href="http://jquery.com/" target="_blanck">jQuery</a>
                                            
                                        </li>
                                        <li>
                                            мало кому известная <a href="http://threejs.org/" target="_blanck">ThreeJS</a>
                                            (<a href="views/scripts/three.min.js" download>ссылка для скачивания</a>)
                                        </li>
                                    </ul>
                                </li>
                                <br/>
                                <li>
                                    Подключите ниже полученный Вами файл скрипта 3D-сцены
                                </li>
                                <br/>
                                <li>
                                    Добавьте в html-разметку блочный элемент (напримет <code>&lt;div&gt</code>) с идентификатором таким же как и имя подключенного файла скрипта 3D-сцены
                                </li>
                                <br/>
                                <li>
                                    Задайте размеры добавленного элемента через CSS или атрибуты
                                </li>
                                <br/>
                                <li>
                                    Готово. Можете пробовать. Получилось? Наслаждайтесь!
                                </li>
                            </ol>
                <!-- ======================================================= -->
                            Пример:<br/>
                                    <pre>
&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset="UTF-8"&gt;
        &lt;title&gt;&lt;/title&gt;
        &lt;script src="script/jquery-2.1.4.min.js"&gt;&lt;/script&gt;
        &lt;script src="script/three.min.js"&gt;&lt;/script&gt;
        &lt;script src="script/3dscript.js"&gt;&lt;/script&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;div id="3dscript" style="width: 700px; height: 400px"&gt;&lt;/div&gt;
    &lt;/body&gt;
&lt;/html&gt;                     </pre>
                            
                            <hr/>
                            <br/>
                <!-- ======================================================= -->
                            <h4>Примечание</h4>
                            <p>
                                Может так случиться, что Вы переименовали файл скрипта и непомните его старое название, следовательно и идентификатор.<br/>
                                Ничего страшного.<br/>
                                Откройте файл в любом текстовом редакторе и найдите следующие строки:
                            <pre>
    function getContainerName(){
        return '3dscript';
    }                       </pre>
                            (Обычно это строки 131...133)<br/>
                            <code>3dscript</code> и есть идентификатор этого скрипта. Можете использовать его или изменить на другой
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
