export default function UserList({
    author,
    authorId,
    score,
    title,
    version,
    uploadTimestamp,
}) {
    return (
        <div className="min-h-screen bg-gray-100">
            <div className="flex justify-center align-items-center flex-col">
                <div className="flex justify-center items-center flex-col mt-5">
                    <h1 className="text-center text-4xl text-gray-900 font-bold">
                        {title}
                    </h1>
                    <a
                        href={route("profile-game", authorId)}
                        className="bg-slate-700 text-center w-28 py-3 rounded-xl text-white mt-2"
                    >
                        {author}
                    </a>
                    <p className="w-[75%] text-center mt-2 text-gray-500">
                        Lorem ipsum dolor sit, amet consectetur adipisicing
                        elit. Ducimus sunt delectus, commodi quos dicta possimus
                        consequuntur et ullam facilis laudantium similique fugit
                        culpa aperiam magni illum necessitatibus asperiores.
                        Exercitationem, id.
                    </p>
                    <h3 className="text-gray-900 text-xl font-medium mt-2">
                        Last Version {version} ({uploadTimestamp})
                    </h3>
                </div>
                <div className="flex justify-center items-center">
                    <div className="w-72 border p-4 rounded-lg ">
                        <h2 className="text-lg font-bold text-gray-900 mb-2">
                            Top 10 Leaderboard
                        </h2>
                        <ol className="list-decimal list-inside text-gray-800">
                            {score.map((score, index) => (
                                <li
                                    key={score.user_id}
                                    className={`${
                                        score.currentUser
                                            ? "font-bold text-black"
                                            : ""
                                    }`}
                                >
                                    {score.user.username} ({score.score})
                                </li>
                            ))}
                        </ol>
                    </div>
                    <div>
                        <img
                            src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
                            width={207}
                            alt="thumbnail"
                        />
                        <div className="flex flex-col">
                            <button className="w-52 mt-3 bg-blue-500 text-white rounded-lg py-3">
                                Download Game
                            </button>
                        </div>
                        <a
                            href={route("manage-game")}
                            className="bg-red-600 w-80 mt-10 -ml-[30%] rounded-lg py-3 text-center font-bold text-slate-100"
                        >
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
}
