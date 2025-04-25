export default function UserList({ user, game, highScore, gameScore }) {
    console.log(gameScore);
    return (
        <div className="min-h-screen bg-gray-100">
            <div className="flex justify-center align-items-center flex-col">
                <div className="flex justify-center items-center flex-col mt-5">
                    <h1 className="text-center text-4xl text-gray-900 font-bold">
                        {user.username}
                    </h1>
                    <h3 className="text-gray-900 text-xl font-medium mt-2">
                        Last Login{" "}
                        {user.last_login_at ? user.last_login_at : "Kosong"}
                    </h3>
                </div>
                <div className="flex justify-evenly flex-col items-center">
                    <div className="w-72 border p-4 rounded-lg ">
                        <h2 className="text-lg font-bold text-gray-900 mb-2">
                            HighScores per games
                        </h2>
                        <ol className="list-decimal list-inside text-gray-800">
                            {highScore.map((score, index) => (
                                <li key={index}>
                                    {score.title} ({score.score})
                                </li>
                            ))}
                        </ol>
                    </div>
                    <h1 className="mb-5 mt-5 mr-64 text-2xl text-gray-900 font-medium">
                        Authored Games
                    </h1>
                    {game.map((data, i) => (
                        <div
                            key={i}
                            className="card card-side bg-gray-300 text-gray-800 shadow-xl"
                        >
                            <figure>
                                <img
                                    src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
                                    alt="Movie"
                                />
                            </figure>
                            <div className="card-body">
                                <h1 className="card-title text-gray-900">
                                    {data.title}{" "}
                                    <span className="text-gray-600">
                                        By {user.username}
                                    </span>
                                </h1>
                                <p>{data.description}</p>
                                <hr
                                    style={{ borderBottom: "1px solid #000" }}
                                />
                                <h4>#score submited: {gameScore}</h4>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
