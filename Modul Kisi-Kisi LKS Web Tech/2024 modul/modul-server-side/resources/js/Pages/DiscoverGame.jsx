import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { useState } from "react";

export default function AdminList({ auth, game }) {
    const [sortGame, setSortGame] = useState([...game]);

    const gameSort = (type, order = "ASC") => {
        const sorted = [...game];
        if (type === "title") {
            sorted.sort((a, b) =>
                order === "ASC"
                    ? a.title.localeCompare(b.title)
                    : b.title.localeCompare(a.title)
            );
        } else if (type === "score") {
            sorted.sort((a, b) =>
                order === "ASC"
                    ? a.scoreCount - b.scoreCount
                    : b.scoreCount - a.scoreCount
            );
        }
        console.log("Sorted Games:", sorted);
        setSortGame(sorted);
    };
    console.log(game);

    return (
        <>
            <AuthenticatedLayout user={auth.user}>
                <div className="text-center mt-5">
                    <h1 className="text-gray-900 font-bold text-3xl">
                        Discover Game
                    </h1>
                </div>

                <div className="flex justify-between items-center mt-10">
                    <h1 className="ml-10 text-3xl text-gray-900 font-bold">
                        300 Game Avaliable
                    </h1>
                    <div className="  mr-10 gap-1 flex">
                        <button
                            onClick={() => gameSort("score")}
                            className="text-gray-900 w-32 btn btn-outline btn-primary"
                        >
                            Popularity
                        </button>
                        <button
                            onClick={() => gameSort("title", "ASC")}
                            className="text-gray-900 btn btn-outline btn-primary"
                        >
                            ASC
                        </button>
                        <button
                            onClick={() => gameSort("title", "DSC")}
                            className="text-gray-900 btn btn-outline btn-primary"
                        >
                            DSC
                        </button>
                    </div>
                </div>

                <section className="flex flex-wrap justify-center gap-4 p-5">
                    {sortGame.map((data, i) => (
                        <div
                            key={i}
                            className="flex w-full md:w-[48%] bg-white shadow-md border rounded-lg p-4"
                        >
                            {/* Gambar */}
                            <figure className="w-1/3 flex justify-center items-center">
                                <img
                                    className="rounded-lg w-full object-cover"
                                    src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.webp"
                                    alt="Game"
                                />
                            </figure>

                            {/* Konten */}
                            <div className="w-2/3 flex flex-col justify-between px-4">
                                <div>
                                    <h1 className="text-lg font-bold text-gray-800">
                                        {data.title}{" "}
                                        <span className="text-sm text-gray-500">
                                            By {data.author}
                                        </span>
                                    </h1>
                                    <p className="text-sm text-gray-600">
                                        {data.description}
                                    </p>
                                </div>
                                <p className="text-xs text-gray-500 mt-2">
                                    #scores submitted : {data.scoreCount}
                                </p>
                            </div>
                        </div>
                    ))}
                </section>
            </AuthenticatedLayout>
        </>
    );
}
