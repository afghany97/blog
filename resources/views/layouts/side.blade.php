<aside class="col-sm-3 ml-sm-auto blog-sidebar">
        <div class="sidebar-module sidebar-module-inset">
          <h4>About</h4>
          <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        </div>
        <div class="sidebar-module">
          <h4>Archives</h4>
          <ol class="list-unstyled">
            @foreach($archives as $archive)
            <li>
              <a href="/posts/?month={{$archive->month}}&year={{$archive->year}}">
                {{$archive->month}}  , {{$archive->year}}
              </a>
            </li>
            @endforeach
          </ol>
        </div>
      
      @if(count($tags))

          <div class="sidebar-module">
            <h4>Tags</h4>
            <ol class="list-unstyled">
              @foreach($tags as $tag)
              <li>
                <a href="/tags/{{$tag->name}}">
                  {{$tag->name}}
                </a>
              </li>
              @endforeach
            </ol>
          </div>
          @endif
        <div class="sidebar-module">
        <div class="sidebar-module">
          <h4>Elsewhere</h4>
          <ol class="list-unstyled">
            <li><a href="https://github.com/afghany97" target="_blank">GitHub</a></li>
            <li><a href="https://twitter.com/afghany97" target="_blank">Twitter</a></li>
            <li><a href="https://www.facebook.com/afghany97" target="_blank">Facebook</a></li>
          </ol>
        </div>
      </aside>