<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Mina Katsuki</title>
    @vite(['resources/scss/app.scss', 'resources/js/client.js'])
  </head>
  <body>
    <div class="wrapper">
      <section class="intro">
        <div class="intro__head start --fade">
          <h1 class="intro__head__title">Mina Katsuki</h1>
          <address class="intro__head__address">info@minakatsuki.org</address>
        </div>
        <p class="intro__description">This is a painting for looking at the paint.</p>
        <nav class="intro__nav start --fade">
          <ul class="intro__nav__list list">
            <li class="list__item" data="bio">
              <div class="list__item__g">
                <img src="{{ asset("storage/parts/arrow.svg") class="list__item__g__arr" }}">
                <p class="list__item__g__cat" id="bio">Biography</p>
              </div>
            </li>
            <li class="list__item" data="work">
              <div class="list__item__g">
                <img src="{{ asset("storage/parts/arrow.svg") class="list__item__g__arr" }}">
                <p class="list__item__g__cat">Works</p>
              </div>
            </li>
            <li class="list__item" data="txt">
              <div class="list__item__g">
                <img src="{{ asset("storage/parts/arrow.svg") class="list__item__g__arr" }}">
                <p class="list__item__g__cat">Text</p>
              </div>
            </li>
          </ul>
        </nav>
      </section>
      <article class="slide">
      </article>
    </div>
  </body>
</html>
