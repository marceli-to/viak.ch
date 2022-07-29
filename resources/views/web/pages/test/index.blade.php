@extends('web.layout.frontend')
@section('page_title', __('Dokumente'))
@section('content')
<style>
  li {
    font-size: 20px;
    list-style-type: disc !important;
  }
  li:before {
    display: none;
  }

  li a {
    display: block;
    padding: 3px 0;
  }
</style>
<section class="container-contact">
  <article class="content-text">
    <div class="text__body">
      <aside>
        <h1 class="xs:hide">Dokumente</h1>
      </aside>
      <div>
        <ul>
          <li>
            <a href="{{ route('pdf.student-attendance-confirmation') }}?v={{time()}}" target="_blank">
              Kursbestätigung
            </a>
          </li>
          <li>
            <a href="{{ route('pdf.student-course-overview') }}?v={{time()}}" target="_blank">
              Kursübersicht
            </a>
          </li>
          <li>
            <a href="{{ route('pdf.course-participants-list') }}?v={{time()}}" target="_blank">
              Teilnehmerliste
            </a>
          </li>
          <li>
            <a href="{{ route('pdf.invoice') }}?v={{time()}}" target="_blank">
              Rechnung
            </a>
          </li>
        </ul>
      </div>
    </div>
  </article>
</section>

@endsection


