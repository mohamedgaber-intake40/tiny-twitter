<style>
    *, *:before, *:after {
        box-sizing: border-box;
    }
    table{
        background: #ddd;
        width: 100%;
    }

    table thead{
        background: black;
        height: 2em;
    }

    table tbody td{
        text-align: center;
        height: 2em;
        border-bottom: 1px solid;
        border-left: 1px solid;
        font-weight: bold;
    }

    table thead th{
       color: #fff;
    }
    .avg{
        font-weight: bold;
    }

</style>
<div class="container ">
    <table >
        <thead>
        <tr>
            <th>User</th>
            <th>Tweets count</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->tweets_count}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="container">
        <p class="avg">Tweets average <span class="avg-number">{{$tweetsPerUserAvg}}</span> per user</p>

    </div>
</div>

