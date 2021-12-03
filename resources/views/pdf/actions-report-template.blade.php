<table>
    <thead>
    <tr>
        <th >User</th>
        <th>Tweets count</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th>{{$user->name}}</th>
            <th>{{$user->tweets_count}}</th>
        </tr>
    @endforeach
    </tbody>
</table>

<p>tweets avg per user : {{$tweetsPerUserAvg}}</p>
