@extends('layouts/contentLayoutMaster')

@section('title', 'Navs')

@section('content')
<!-- Horizontal Nav starts -->
<section id="horizontal-base-nav">
  <div class="row match-height">
    <!-- Base Nav starts -->
    <div class="col-md-6 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Base Nav</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            The base <code>.nav</code> component is built with flexbox and provide a strong foundation for building all
            types of navigation components.
          </p>
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="javascript:void(0);" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Base Nav ends -->

    <!-- With Border starts -->
    <div class="col-md-6 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">With Border</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Use Class <code>.wrap-border</code> with your <code>&lt;nav&gt;</code> tag to wrap your nav with a border.
          </p>
          <ul class="nav wrap-border">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="javascript:void(0);" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- With Border ends -->

    <!-- Center Alignment starts -->
    <div class="col-md-6 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Center Alignment</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Use Class <code>.justify-content-center</code> with your <code>&lt;nav&gt;</code> tag to align your nav to
            center.
          </p>
          <ul class="nav justify-content-center">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="javascript:void(0);" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Center Alignment ends -->

    <!-- End Alignment starts -->
    <div class="col-md-6 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">End Alignment</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Use Class <code>.justify-content-end</code> with your <code>&lt;nav&gt;</code> tag to align your nav to end.
          </p>
          <ul class="nav justify-content-end">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="javascript:void(0);" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Alignment ends -->
  </div>
</section>
<!-- Horizontal Nav Ends -->

<!-- Basic Vertical Navs start -->
<section id="basic-nav-components">
  <div class="row match-height">
    <!-- Vertical Nav starts -->
    <div class="col-lg-6 col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Vertical nav</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            Roll your own navigation style by extending the base <code>.nav</code> component. All Bootstrap’s nav
            components are built on top of this by specifying additional styles.
          </p>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="javascript:void(0);">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Vertical Nav ends -->

    <!-- Vertical Nav with Border starts -->
    <div class="col-lg-6 col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Nav with Border</h4>
        </div>
        <div class="card-body">
          <p class="card-text">To wrap with border, use <code>.wrap-border</code> class.</p>
          <ul class="nav flex-column wrap-border">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="javascript:void(0);">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Vertical Nav with Border ends -->

    <!-- Vertical Nav with Square Border starts -->
    <div class="col-lg-6 col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Nav with Square Border</h4>
        </div>
        <div class="card-body">
          <p class="card-text">
            To wrap with square border, use <code>.square-border</code> class with <code>.wrap-border</code> class.
          </p>
          <ul class="nav flex-column wrap-border square-border">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="javascript:void(0);">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Vertical Nav with Square Border ends -->

    <!-- Vertical Nav with Divider starts -->
    <div class="col-lg-6 col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Nav with Divider</h4>
        </div>
        <div class="card-body">
          <p class="card-text">To add divider, use <code>.dropdown-divider</code> class to <code>&lt;li&gt;</code>.</p>
          <ul class="nav flex-column wrap-border">
            <li class="nav-item">
              <a class="nav-link active" href="javascript:void(0);">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);">Link</a>
            </li>
            <li class="dropdown-divider"></li>
            <li class="nav-item">
              <a class="nav-link disabled" href="javascript:void(0);">Disabled</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Vertical Nav with Divider ends -->
  </div>
</section>
<!-- Basic Vertical Navs end -->
@endsection
