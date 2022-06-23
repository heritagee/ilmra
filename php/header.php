
<!-- header -->
    <header class="header_2">
        <div class="container">

            <div class="header_items">

                <div class="header_menu">

                    <div id="menu" class="option__main">
                        <div id="burger-container">
                          <div class="burger-line" style="background-color: #fff;"></div>
                          <div class="burger-line" style="background-color: #fff;"></div>
                          <div class="burger-line" style="background-color: #fff;"></div>
                        </div>

                    </div>

                    <div id="option-container" class="invisible width-a">
                        <div id="back-timeline" class="option__main option__large">
                            <a href="index.php" class="burger_text">Главная</a>
                        </div>
                        <div id="full-screen" class="option__main option__large">
                            <a href="catalog.php" class="burger_text">Каталог</a>
                        </div>
                        <div id="full-screen" class="option__main option__large">
                            <a href="catalog.php?type=Верхняя одежда" class="burger_text">Верхняя одежда</a>
                        </div>
                        <div id="full-screen" class="option__main option__large">
                            <a href="catalog.php?type=Футболки" class="burger_text">Футболки</a>
                        </div>
                        <div id="full-screen" class="option__main option__large">
                            <a href="catalog.php?type=Нижнее белье" class="burger_text">Нижнее белье</a>
                        </div>
                        <div id="full-screen" class="option__main option__large">
                            <a href="catalog.php?type=Топы" class="burger_text">Топы</a>
                        </div>
                        <div id="full-screen" class="option__main option__large">
                            <a href="catalog.php?type=Низ" class="burger_text">Низ</a>
                        </div>
                        <div id="full-screen" class="option__main option__large">
                            <a href="catalog.php?type=Головные уборы" class="burger_text">Головные уборы</a>
                        </div>
                        <div id="full-screen" class="option__main option__large">
                            <a href="catalog.php?type=Обувь" class="burger_text">Обувь</a>
                        </div>
                        <div id="full-screen" class="option__main option__large">
                            <a href="catalog.php?type=Акссесуары" class="burger_text">Акссесуары</a>
                        </div>


                    </div>

                    <div class="header_logo">
                        <a href="index.php" style="text-decoration: none;">
                        <h1 class="logo" style="color: #fff;">ILMRA</h1></a>
                    </div>

                </div>

                <div class="header_icons">
                    <? 
                    // показывает сколько товаров
                    $allTovar = $link->query("SELECT COUNT(id) as count FROM `orders` WHERE `id_user` = '{$_SESSION['user']['id']}' AND `status` = 0")->fetch(2)['count'];
                    ?>
                     
                    <div class="header_basket">
                        <div class="basket_count">
                            <p class="black_p"><?=$allTovar; ?></p>
                        </div>
                        <a href="basket.php">
                        <svg width="30" height="30" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M37.9453 15.5078C37.1093 14.4609 35.9687 13.8828 34.7343 13.8828H31.914C31.6484 6.64844 26.4062 0.859375 20 0.859375C13.5937 0.859375 8.35153 6.64844 8.08591 13.8828H5.26559C4.03122 13.8828 2.89059 14.4609 2.05466 15.5078C0.999969 16.8203 0.617157 18.6484 1.01559 20.4062L4.39841 35.3125C4.90622 37.5625 6.65622 39.1406 8.64841 39.1406H31.3437C33.3359 39.1406 35.0859 37.5703 35.5937 35.3125L38.9843 20.4062C39.3828 18.6484 39 16.8203 37.9453 15.5078ZM20 4.04688C24.6562 4.04688 28.4687 8.40625 28.7187 13.8828H11.2812C11.5312 8.41406 15.3437 4.04688 20 4.04688ZM35.875 19.6953L32.4922 34.6094C32.3203 35.375 31.8281 35.9531 31.3515 35.9531H8.64841C8.17184 35.9531 7.67966 35.375 7.50778 34.6094L4.12497 19.6953C3.94528 18.9062 3.83591 17.0703 5.26559 17.0703H34.7343C36.2734 17.0703 36.0547 18.9062 35.875 19.6953Z" fill="white"/>
                            <path d="M12.0859 20.2422C11.2031 20.2422 10.4922 20.9531 10.4922 21.8359V31.7969C10.4922 32.6797 11.2031 33.3906 12.0859 33.3906C12.9688 33.3906 13.6797 32.6797 13.6797 31.7969V21.8359C13.6875 20.9609 12.9688 20.2422 12.0859 20.2422Z" fill="white"/>
                            <path d="M19.8125 20.2422C18.9297 20.2422 18.2188 20.9531 18.2188 21.8359V31.7969C18.2188 32.6797 18.9297 33.3906 19.8125 33.3906C20.6953 33.3906 21.4062 32.6797 21.4062 31.7969V21.8359C21.4062 20.9609 20.6875 20.2422 19.8125 20.2422Z" fill="white"/>
                            <path d="M27.5312 20.2422C26.6484 20.2422 25.9375 20.9531 25.9375 21.8359V31.7969C25.9375 32.6797 26.6484 33.3906 27.5312 33.3906C28.4141 33.3906 29.125 32.6797 29.125 31.7969V21.8359C29.125 20.9609 28.4141 20.2422 27.5312 20.2422Z" fill="white"/>
                            </svg>
                        </a>
                    </div>

                    <div class="header_profile">
                        <a href="profile.php">
                        <svg width="32" height="32" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.6642 21.0481L16.6642 21.0481C15.4438 19.3841 14.6924 17.2302 14.6924 15.4484C14.6924 11.9707 17.5223 9.14087 21 9.14087C24.4777 9.14087 27.3076 11.9707 27.3076 15.4484C27.3076 17.2685 26.5548 19.3597 25.3668 20.9955C24.173 22.6391 22.6002 23.7454 21 23.7454C19.5399 23.7454 17.9495 22.8009 16.6642 21.0481ZM24.4905 29.2582L24.4905 29.2582C25.357 28.7331 26.4172 28.8072 27.1321 29.4129C29.1251 31.1018 30.3279 33.5256 30.4746 36.1171C27.7273 37.8453 24.4787 38.846 21 38.846C17.5212 38.8458 14.2726 37.8452 11.5253 36.1169C11.6718 33.5274 12.868 31.1106 14.8596 29.4194C15.5792 28.8084 16.6425 28.7326 17.5091 29.2577C18.6245 29.9337 19.8002 30.2825 21.0004 30.2825C22.2003 30.2825 23.3756 29.9338 24.4905 29.2582ZM32.7787 34.3952C32.267 31.7267 30.8589 29.2888 28.7509 27.5025L28.7509 27.5025C27.2015 26.1898 24.9669 26.0416 23.1928 27.1167C21.7439 27.9946 20.2562 27.9945 18.8069 27.1163C17.0303 26.0396 14.7918 26.1919 13.2386 27.5108L13.4652 27.7776L13.2386 27.5108C11.1329 29.299 9.72995 31.7301 9.21966 34.3938C5.50221 31.1203 3.15406 26.3292 3.15406 21.0001C3.15406 11.16 11.1601 3.15406 21 3.15406C30.84 3.15406 38.846 11.16 38.846 21C38.846 26.3298 36.4972 31.1216 32.7787 34.3952ZM21 6.63682C16.1409 6.63682 12.1884 10.5894 12.1884 15.4484C12.1884 17.796 13.1105 20.4368 14.645 22.529C16.3819 24.8974 18.6333 26.2495 21 26.2495C23.3668 26.2495 25.6181 24.8976 27.3552 22.529C28.8896 20.4368 29.8117 17.796 29.8117 15.4484C29.8117 10.5894 25.8591 6.63682 21 6.63682ZM21 0.65C9.77875 0.65 0.65 9.77863 0.65 21C0.65 32.2213 9.77863 41.35 21 41.35C32.2214 41.35 41.35 32.2214 41.35 21C41.35 9.77863 32.2213 0.65 21 0.65Z" fill="white" stroke="white" stroke-width="0.7"/>
                            </svg>
                        </a>
                    </div>

                    <? if($_SESSION['user']): ?>

                        <div class="header_profile">
                            <a href="php/exit.php">
                                <svg width="30" height="30" viewBox="0 0 385 385" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_96_4)">
                                        <path d="M180.455 360.91H24.061V24.061H180.455C187.096 24.061 192.485 18.671 192.485 12.031C192.485 5.39098 187.095 0.000976562 180.455 0.000976562H12.03C5.39 0.000976562 0 5.38998 0 12.031V372.94C0 379.581 5.39 384.97 12.03 384.97H180.454C187.095 384.97 192.484 379.58 192.484 372.94C192.485 366.299 187.095 360.91 180.455 360.91Z" fill="white"/>
                                        <path d="M381.481 184.088L298.472 99.888C293.768 95.136 286.153 95.148 281.461 99.888C276.757 104.628 276.757 112.327 281.461 117.067L344.019 180.527H96.279C89.638 180.527 84.249 185.965 84.249 192.678C84.249 199.391 89.639 204.829 96.279 204.829H344.019L281.461 268.289C276.757 273.041 276.757 280.728 281.461 285.468C286.165 290.22 293.78 290.22 298.472 285.468L381.469 201.268C386.113 196.588 386.161 188.756 381.481 184.088Z" fill="white"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_96_4">
                                            <rect width="384.971" height="384.971" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </div>

                    <? endif; ?>

                </div>

            </div>
        </div>

    </header>