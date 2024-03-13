import Page from './page.mdx'

const Home: React.FC = () => {
    return (
        <div className='min-h-screen bg-black'>
            <article className='mx-auto max-w-screen-lg py-4 prose dark:prose-invert leading-relaxed'>
                <Page />
            </article>
        </div>
    )
}

export default Home
