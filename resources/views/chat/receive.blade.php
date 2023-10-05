<li class="media sent">
    <span class="contact-status busy"></span>
    <img class="img-fluid align-self-start mr-3" src="{{ $profile }}" width="57" height="57" />
    <div class="media-body">
        <div class="date_time">{{ formatCreatedAt($time) }}</div>
        <p>{{ $message }}</p>
    </div>
</li>